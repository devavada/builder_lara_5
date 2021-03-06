<?php

namespace Vis\Builder\Fields;

use Illuminate\Support\Facades\DB;

class ManyToManyField extends AbstractField
{
    public function isEditable()
    {
        return true;
    }

    // end isEditable

    public function onSearchFilter(&$db, $value)
    {
        if ($value) {
            $mtmTable = $this->getAttribute('mtm_table');
            $mtmExternalTable = $this->getAttribute('mtm_external_table');
            $mtmKeyField = $this->getAttribute('mtm_key_field');
            $mtmExternalKeyField = $this->getAttribute('mtm_external_key_field');
            $mtmExternalForeignKeyField = $this->getAttribute('mtm_external_foreign_key_field');
            $mtmExternalValueField = $this->getAttribute('mtm_external_value_field');

            $searchResult = DB::table($mtmTable)
                ->leftJoin($mtmExternalTable, $mtmExternalTable.'.'.$mtmExternalForeignKeyField, '=', $mtmTable.'.'.$mtmExternalKeyField)
                ->where($mtmExternalValueField, 'like', '%'.$value.'%')
                ->select($mtmKeyField)->pluck($mtmKeyField);

            $db->whereIn($this->definition['db']['table'].'.id', $searchResult);
        }
    }

    // end onSearchFilter

    public function onPrepareRowValues($values, $id)
    {
        // we get comma separated values in string if select2 ajax search
        $values = is_array($values) ? $values : explode(',', $values);

        $delete = DB::table($this->getAttribute('mtm_table'))
            ->where($this->getAttribute('mtm_key_field'), $id);

        if ($this->getAttribute('mtm_external_model')) {
            $delete = $delete->where($this->getAttribute('mtm_external_model'), $this->definition['options']['model']);
        }

        $delete->delete();

        $data = [];
        if ($this->getAttribute('show_type') == 'extra') {
            foreach ($values as $info) {
                $temp = [
                    $this->getAttribute('mtm_key_field')          => $id,
                    $this->getAttribute('mtm_external_key_field') => $info['id'],
                ];

                $extraFields = $this->getAttribute('extra_fields', []);
                foreach ($extraFields as $fieldName => $fieldInfo) {
                    $temp[$fieldName] = $info[$fieldName];
                }

                $data[] = $temp;
            }
        } else {
            $values = array_filter($values);
            // HACK: in checkbox we have id as key of element, in select - as value
            $isInValueElement = ($this->getAttribute('show_type', 'checkbox') == 'select2' || $this->getAttribute('show_type', 'checkbox') == 'select3' || $this->getAttribute('show_type', 'checkbox') == 'select_tree');
            foreach ($values as $key => $val) {
                $externalID = $isInValueElement ? $val : $key;
                $data[$key] = [
                    $this->getAttribute('mtm_key_field')          => $id,
                    $this->getAttribute('mtm_external_key_field') => $externalID,
                ];

                if ($this->getAttribute('mtm_external_model')) {
                    $data[$key][$this->getAttribute('mtm_external_model')] = $this->definition['options']['model'];
                }
            }
        }

        if ($data) {
            DB::table($this->getAttribute('mtm_table'))->insert($data);
        }
    }

    // end onPrepareRowValues

    public function onSelectValue(&$db)
    {
        // HACK: we dont need this method to be called for many2many field
    }

    // end onSelectValue

    public function getValue($row, $postfix = '')
    {
        if ($this->hasCustomHandlerMethod('onGetValue')) {
            $res = $this->handler->onGetValue($this, $row, $postfix);
            if ($res) {
                return $res;
            }
        }

        $assocTable = $this->getAttribute('mtm_table');
        $extTable = $this->getAttribute('mtm_external_table');
        $assocKeyField = $this->getAttribute('mtm_key_field');
        $assocExtKeyField = $this->getAttribute('mtm_external_key_field');
        $extKeyField = $this->getAttribute('mtm_external_foreign_key_field');
        $extValueField = $this->getAttribute('mtm_external_value_field');
        $value = DB::table($assocTable)
            ->join($extTable, $assocTable.'.'.$assocExtKeyField, '=', $extTable.'.'.$extKeyField)
            ->where($assocTable.'.'.$assocKeyField, $row['id'])->value($extValueField);

        return $value;
    }

    // end getValue

    public function getListValue($row)
    {
        if ($this->hasCustomHandlerMethod('onGetListValue')) {
            $res = $this->handler->onGetListValue($this, $row);
            if ($res) {
                return $res;
            }
        }

        return implode(', ', $this->getRelatedExternalFieldOptions($row));
    }

    // end getListValue

    public function getEditInput($row = [])
    {
        if ($this->hasCustomHandlerMethod('onGetEditInput')) {
            $res = $this->handler->onGetEditInput($this, $row);
            if ($res) {
                return $res;
            }
        }

        $showType = $this->getAttribute('show_type', 'checkbox');

        if ($showType == 'extra') {
            return $this->getEditInputWithExtra($row);
        }
        if ($showType == 'select2' && $this->getAttribute('select2_search')) {
            return $this->getEditInputSelectWithAjaxSearch($row);
        }

        $input = view('admin::tb.input_many2many_'.$showType);
        $input->selected = [];
        if ($row) {
            $input->selected = $this->getRelatedExternalFieldOptions($row);
        }

        $input->link = $this->getAttribute('with_link');
        $input->name = $this->getFieldName();
        $input->divide = $this->getAttribute('divide_columns', 2);

        if ($showType == 'select_tree') {
            $input->options = $this->getFieldOptionForTree();
        } else {
            $input->options = $this->doDivideOnParts(
                $this->getAllExternalFieldOptions(),
                $this->getAttribute('divide_columns', 2)
            );
        }

        return $input->render();
    }

    // end getEditInput

    private function getEditInputSelectWithAjaxSearch($row)
    {
        $input = view('admin::tb.input_many2many_select2_search');

        $data = [];
        if ($row) {
            $selected = $this->getRelatedExternalFieldOptions($row);
            foreach ($selected as $id => $title) {
                $data[] = [
                    'id'   => $id,
                    'name' => $title,
                ];
            }
        }
        $input->selected = json_encode($data);

        $input->postfix = $row ? '_e' : '_c';
        $input->link = $this->getAttribute('with_link');
        $input->name = $this->getFieldName();
        $input->search = $this->getAttribute('select2_search');
        $input->row = $row;
        $input->insert = $this->getAttribute('insert');
        $input->attributes = json_encode($this->attributes);

        return $input->render();
    }

    // end getEditInputSelectWithAjaxSearch

    private function getEditInputWithExtra($row)
    {
        $input = view('admin::tb.input_many2many_extra');

        $input->selected = [];
        if ($row) {
            $input->selected = $this->getRelatedExternalFieldOptions($row, true);
        }

        $input->postfix = $row ? '_e' : '_c';
        $input->name = $this->getFieldName();
        $input->options = $this->getAllExternalFieldOptions(true);
        $input->extra = $this->getAttribute('extra_fields');

        return $input->render();
    }

    // end getEditInputWithExtra

    private function doDivideOnParts($array, $segmentCount)
    {
        $dataCount = count($array);
        if ($dataCount === 0) {
            // HACK: when there is no many2many options
            return [[]];
        }

        $segmentLimit = ceil($dataCount / $segmentCount);
        $outputArray = array_chunk($array, $segmentLimit, true);

        return $outputArray;
    }

    // end doDivideOnParts

    protected function getRelatedExternalFieldOptions($row, $isGetAll = false)
    {
        $keyField = $this->getAttribute('mtm_table').'.'.$this->getAttribute('mtm_external_key_field');
        $valueField = $this->getAttribute('mtm_external_table').'.'.$this->getAttribute('mtm_external_value_field');
        $externalTable = $this->getAttribute('mtm_external_table');
        $externalForeignKey = $externalTable.'.'.$this->getAttribute('mtm_external_foreign_key_field');

        $options = DB::table($this->getAttribute('mtm_table'));
        $options->select($keyField, $valueField);
        if ($isGetAll) {
            $options->addSelect($this->getAttribute('mtm_table').'.*');
        }

        $options->join($externalTable, $keyField, '=', $externalForeignKey);

        $this->additionalWhere($options);

        $options->where($this->getAttribute('mtm_key_field'), $row['id']);

        if ($this->getAttribute('mtm_external_model')) {
            $options->where($this->getAttribute('mtm_external_model'), $this->definition['options']['model']);
        }

        $externalOrder = $this->getAttribute('mtm_external_order');
        if ($externalOrder) {
            if (is_callable($externalOrder)) {
                $externalOrder($options);
            } else {
                foreach ($externalOrder as $key => $opt) {
                    $options->orderBy($key, $opt);
                }
            }
        }
        if ($this->getAttribute('show_type') == 'select3') {
            $res = $options->orderBy($this->getAttribute('mtm_table').'.id', 'asc')->get();
        } else {
            $res = $options->get();
        }

        $options = [];
        foreach ($res as $opt) {
            $opt = (array) $opt;
            $id = $opt[$this->getAttribute('mtm_external_key_field')];
            $value = $opt[$this->getAttribute('mtm_external_value_field')];

            if ($isGetAll) {
                $options[$id] = [
                    'value' => $value,
                    'info'  => $opt,
                ];
            } else {
                $options[$id] = $value;
            }
        }

        return $options;
    }

    // end getRelatedExternalFieldOptions

    protected function getAllExternalFieldOptions($isGetAll = false)
    {
        $valueField = $this->getAttribute('mtm_external_table').'.'.$this->getAttribute('mtm_external_value_field');
        $externalTable = $this->getAttribute('mtm_external_table');
        $externalForeignKey = $externalTable.'.'.$this->getAttribute('mtm_external_foreign_key_field');

        $options = DB::table($externalTable);
        if (! $isGetAll) {
            $options->select($externalForeignKey, $valueField);
        }

        $this->additionalWhere($options);

        $this->externalTableOrder($options);

        $res = $options->get();
        $options = [];
        foreach ($res as $opt) {
            $opt = (array) $opt;
            $id = $opt[$this->getAttribute('mtm_external_foreign_key_field')];
            $value = $opt[$this->getAttribute('mtm_external_value_field')];

            if ($isGetAll) {
                $options[$id] = [
                    'value' => $value,
                    'info'  => $opt,
                ];
            } else {
                $options[$id] = $value;
            }
        }

        return $options;
    }

    // end getAllExternalFieldOptions

    public function getFieldOptionForTree()
    {
        $params = $this->getAttribute('type_tree_params');
        $model = $params['model'];
        $options = $model::where('parent_id', $params['start_id_folder']);

        $this->additionalWhere($options);

        $res = $options->orderBy('parent_id')->get();

        return $res;
    }

    public function getAjaxSearchResult($query, $limit, $page)
    {
        if ($this->hasCustomHandlerMethod('onGetAjaxSearchResult')) {
            $res = $this->handler->onGetAjaxSearchResult($this, $query, $limit, $page);
            if ($res) {
                return $res;
            }
        }

        $results = DB::table($this->getAttribute('mtm_external_table'))
            ->select('id', $this->getAttribute('mtm_external_value_field'))
            ->where($this->getAttribute('mtm_external_value_field'), 'LIKE', '%'.$query.'%')
            ->take($limit)
            ->skip(($limit * $page) - $limit);

        $this->additionalWhere($results);

        $this->externalTableOrder($results);

        $results = $results->get();
        $results = $results ?: [];

        $res = [];

        foreach ($results as $result) {
            $result = (array) $result;
            $res[] = [
                'id'   => $result['id'],
                'name' => $result[$this->getAttribute('mtm_external_value_field')],
            ];
        }

        return [
            'results' => $res,
            'more'    => $res && ! empty($res),
            'message' => '',
        ];
    }

    // end getAjaxSearchResult

    private function externalTableOrder(&$options)
    {
        if ($this->getAttribute('mtm_external_table_order')) {
            foreach ($this->getAttribute('mtm_external_table_order') as $key => $opt) {
                $options->orderBy($key, $opt);
            }
        }
    }

    private function additionalWhere(&$results)
    {
        $additionalWheres = $this->getAttribute('additional_where');

        if (is_array($additionalWheres)) {
            foreach ($this->getAttribute('additional_where') as $key => $opt) {
                if ($opt['sign'] == 'in') {
                    $results->whereIn($key, $opt['value']);
                } else {
                    $results->where($key, $opt['sign'], $opt['value']);
                }
            }
        }

        if (is_object($additionalWheres)) {
            $additionalWheres($results);
        }
    }
}
