<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92ce10362f3539484f1905e296aad13e
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vis\\Builder\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vis\\Builder\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'CreateActivationsTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_100056_create_activations_table.php',
        'CreatePersistencesTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_103113_create_persistences_table.php',
        'CreateRemindersTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_103444_create_reminders_table.php',
        'CreateRevisions' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_141402_create_revisions.php',
        'CreateRoleUsersTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_095823_create_role_users_table.php',
        'CreateRolesTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_094422_create_roles_table.php',
        'CreateSettingSelectTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_104132_create_setting_select_table.php',
        'CreateSettingsTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_103844_create_settings_table.php',
        'CreateTbTreeTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_104452_create_tb_tree_table.php',
        'CreateThrottleTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_105621_create_throttle_table.php',
        'CreateTranslationsCmsTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_110107_create_translations_cms_table.php',
        'CreateTranslationsPhrasesCmsTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_105933_create_translations_phrases_cms_table.php',
        'CreateUsersTable' => __DIR__ . '/../..' . '/src/Migrations/2018_02_22_093849_create_users_table.php',
        'Vis\\Builder\\AdminSeeder' => __DIR__ . '/../..' . '/src/Seeds/AdminSeeder.php',
        'Vis\\Builder\\Authenticate' => __DIR__ . '/../..' . '/src/Http/Middleware/Authenticate.php',
        'Vis\\Builder\\AuthenticateFrontend' => __DIR__ . '/../..' . '/src/Http/Middleware/AuthenticateFrontend.php',
        'Vis\\Builder\\BaseController' => __DIR__ . '/../..' . '/src/Http/Controllers/LogViewerController.php',
        'Vis\\Builder\\CreateConfig' => __DIR__ . '/../..' . '/src/Console/CreateConfig.php',
        'Vis\\Builder\\DashboardController' => __DIR__ . '/../..' . '/src/Http/Controllers/DashboardController.php',
        'Vis\\Builder\\EditorController' => __DIR__ . '/../..' . '/src/Http/Controllers/EditorController.php',
        'Vis\\Builder\\Event' => __DIR__ . '/../..' . '/src/Models/Event.php',
        'Vis\\Builder\\Facades\\Jarboe' => __DIR__ . '/../..' . '/src/Http/Facades/Jarboe.php',
        'Vis\\Builder\\Fields\\AbstractField' => __DIR__ . '/../..' . '/src/Http/Fields/AbstractField.php',
        'Vis\\Builder\\Fields\\CheckboxField' => __DIR__ . '/../..' . '/src/Http/Fields/CheckboxField.php',
        'Vis\\Builder\\Fields\\ColorField' => __DIR__ . '/../..' . '/src/Http/Fields/ColorField.php',
        'Vis\\Builder\\Fields\\CustomField' => __DIR__ . '/../..' . '/src/Http/Fields/CustomField.php',
        'Vis\\Builder\\Fields\\DateField' => __DIR__ . '/../..' . '/src/Http/Fields/DateField.php',
        'Vis\\Builder\\Fields\\DatetimeField' => __DIR__ . '/../..' . '/src/Http/Fields/DatetimeField.php',
        'Vis\\Builder\\Fields\\DefinitionField' => __DIR__ . '/../..' . '/src/Http/Fields/DefinitionField.php',
        'Vis\\Builder\\Fields\\FileField' => __DIR__ . '/../..' . '/src/Http/Fields/FileField.php',
        'Vis\\Builder\\Fields\\FileStorageField' => __DIR__ . '/../..' . '/src/Http/Fields/FileStorageField.php',
        'Vis\\Builder\\Fields\\ForeignField' => __DIR__ . '/../..' . '/src/Http/Fields/ForeignField.php',
        'Vis\\Builder\\Fields\\GroupField' => __DIR__ . '/../..' . '/src/Http/Fields/GroupField.php',
        'Vis\\Builder\\Fields\\ImageField' => __DIR__ . '/../..' . '/src/Http/Fields/ImageField.php',
        'Vis\\Builder\\Fields\\ImageStorageField' => __DIR__ . '/../..' . '/src/Http/Fields/ImageStorageField.php',
        'Vis\\Builder\\Fields\\ManyToManyField' => __DIR__ . '/../..' . '/src/Http/Fields/ManyToManyField.php',
        'Vis\\Builder\\Fields\\PatternField' => __DIR__ . '/../..' . '/src/Http/Fields/PatternField.php',
        'Vis\\Builder\\Fields\\ReadonlyField' => __DIR__ . '/../..' . '/src/Http/Fields/ReadonlyField.php',
        'Vis\\Builder\\Fields\\SelectField' => __DIR__ . '/../..' . '/src/Http/Fields/SelectField.php',
        'Vis\\Builder\\Fields\\SetField' => __DIR__ . '/../..' . '/src/Http/Fields/SetField.php',
        'Vis\\Builder\\Fields\\Subactions\\AbstractSubaction' => __DIR__ . '/../..' . '/src/Http/Fields/Subactions/AbstractSubaction.php',
        'Vis\\Builder\\Fields\\Subactions\\Translate' => __DIR__ . '/../..' . '/src/Http/Fields/Subactions/Translate.php',
        'Vis\\Builder\\Fields\\TextField' => __DIR__ . '/../..' . '/src/Http/Fields/TextField.php',
        'Vis\\Builder\\Fields\\TextareaField' => __DIR__ . '/../..' . '/src/Http/Fields/TextareaField.php',
        'Vis\\Builder\\Fields\\TimeField' => __DIR__ . '/../..' . '/src/Http/Fields/TimeField.php',
        'Vis\\Builder\\Fields\\TimestampField' => __DIR__ . '/../..' . '/src/Http/Fields/TimestampField.php',
        'Vis\\Builder\\Fields\\WysiwygField' => __DIR__ . '/../..' . '/src/Http/Fields/WysiwygField.php',
        'Vis\\Builder\\GeneratePassword' => __DIR__ . '/../..' . '/src/Console/GeneratePassword.php',
        'Vis\\Builder\\Group' => __DIR__ . '/../..' . '/src/Models/Group.php',
        'Vis\\Builder\\Handlers\\ActionsHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/ActionsHandler.php',
        'Vis\\Builder\\Handlers\\ButtonsHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/ButtonsHandler.php',
        'Vis\\Builder\\Handlers\\CustomClosureHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/CustomClosureHandler.php',
        'Vis\\Builder\\Handlers\\CustomHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/CustomHandler.php',
        'Vis\\Builder\\Handlers\\DefinitionHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/DefinitionHandler.php',
        'Vis\\Builder\\Handlers\\ExportHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/ExportHandler.php',
        'Vis\\Builder\\Handlers\\ImportHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/ImportHandler.php',
        'Vis\\Builder\\Handlers\\QueryHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/QueryHandler.php',
        'Vis\\Builder\\Handlers\\RequestHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/RequestHandler.php',
        'Vis\\Builder\\Handlers\\ViewHandler' => __DIR__ . '/../..' . '/src/Http/Handlers/ViewHandler.php',
        'Vis\\Builder\\Helpers\\GroupsHandler' => __DIR__ . '/../..' . '/src/Http/Helpers/GroupsHandler.php',
        'Vis\\Builder\\Helpers\\SlugHandler' => __DIR__ . '/../..' . '/src/Http/Helpers/SlugHandler.php',
        'Vis\\Builder\\Helpers\\Traits\\GroupsFieldTrait' => __DIR__ . '/../..' . '/src/Http/Traits/GroupsFieldTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\ImagesTrait' => __DIR__ . '/../..' . '/src/Http/Traits/ImagesTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\Query\\Builder' => __DIR__ . '/../..' . '/src/Http/Traits/Query/Builder.php',
        'Vis\\Builder\\Helpers\\Traits\\QuickEditTrait' => __DIR__ . '/../..' . '/src/Http/Traits/QuickEditTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\Rememberable' => __DIR__ . '/../..' . '/src/Http/Traits/Rememberable.php',
        'Vis\\Builder\\Helpers\\Traits\\SeoTrait' => __DIR__ . '/../..' . '/src/Http/Traits/SeoTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\TranslateTrait' => __DIR__ . '/../..' . '/src/Http/Traits/TranslateTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\ViewPageTrait' => __DIR__ . '/../..' . '/src/Http/Traits/ViewPageTrait.php',
        'Vis\\Builder\\Helpers\\Traits\\ViewedTrait' => __DIR__ . '/../..' . '/src/Http/Traits/ViewedTrait.php',
        'Vis\\Builder\\Helpers\\URLify' => __DIR__ . '/../..' . '/src/libs/URLify.php',
        'Vis\\Builder\\Helpers\\UsersHandler' => __DIR__ . '/../..' . '/src/Http/Helpers/UsersHandler.php',
        'Vis\\Builder\\Img' => __DIR__ . '/../..' . '/src/libs/Img.php',
        'Vis\\Builder\\InstallCommand' => __DIR__ . '/../..' . '/src/Console/InstallCommand.php',
        'Vis\\Builder\\JarboeController' => __DIR__ . '/../..' . '/src/Http/Controllers/JarboeController.php',
        'Vis\\Builder\\LocalizationMiddlewareRedirect' => __DIR__ . '/../..' . '/src/Http/Middleware/LocalizationMiddlewareRedirect.php',
        'Vis\\Builder\\LogViewerController' => __DIR__ . '/../..' . '/src/Http/Controllers/LogViewerController.php',
        'Vis\\Builder\\LoginController' => __DIR__ . '/../..' . '/src/Http/Controllers/LoginController.php',
        'Vis\\Builder\\OptmizationImg' => __DIR__ . '/../..' . '/src/libs/OptmizationImg.php',
        'Vis\\Builder\\Revision' => __DIR__ . '/../..' . '/src/Models/Revision.php',
        'Vis\\Builder\\Setting' => __DIR__ . '/../..' . '/src/Models/Setting.php',
        'Vis\\Builder\\SettingSelect' => __DIR__ . '/../..' . '/src/Models/SettingSelect.php',
        'Vis\\Builder\\SettingsController' => __DIR__ . '/../..' . '/src/Http/Controllers/SettingsController.php',
        'Vis\\Builder\\TBController' => __DIR__ . '/../..' . '/src/Http/Controllers/TBController.php',
        'Vis\\Builder\\TBTreeController' => __DIR__ . '/../..' . '/src/Http/Controllers/TBTreeController.php',
        'Vis\\Builder\\TableAdminController' => __DIR__ . '/../..' . '/src/Http/Controllers/TableAdminController.php',
        'Vis\\Builder\\Tree' => __DIR__ . '/../..' . '/src/Models/Tree.php',
        'Vis\\Builder\\TreeCatalogController' => __DIR__ . '/../..' . '/src/Http/Controllers/TreeCatalogController.php',
        'Vis\\Builder\\TreeController' => __DIR__ . '/../..' . '/src/Http/Controllers/TreeController.php',
        'Vis\\Builder\\TreeObserver' => __DIR__ . '/../..' . '/src/Models/TreeObserver.php',
        'Vis\\Builder\\User' => __DIR__ . '/../..' . '/src/Models/User.php',
        'Vis\\Builder\\Watermark' => __DIR__ . '/../..' . '/src/libs/Watermark.php',
        'Vis\\TranslationsCMS\\Trans' => __DIR__ . '/../..' . '/src/Models/Trans.php',
        'Vis\\TranslationsCMS\\Translate' => __DIR__ . '/../..' . '/src/Models/Translate.php',
        'Vis\\TranslationsCMS\\TranslateController' => __DIR__ . '/../..' . '/src/Http/Controllers/TranslateController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92ce10362f3539484f1905e296aad13e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92ce10362f3539484f1905e296aad13e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit92ce10362f3539484f1905e296aad13e::$classMap;

        }, null, ClassLoader::class);
    }
}
