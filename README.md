<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

<h3>First coding exercise:</h3>
<p>Create sample registration form for both legal bodies and individual persons</p>
<p>Files changes:</p>
<ul>
    <li>common/config/main-local.php - modify db component for selected dbms and created db</li>
<li>console/migrations/m130524_201442_init.php - create table for ActiveRecords created by form</li>
<li>common/models/SkyUser.php - ActiveRecord for models created by form</li>
<li>frontend/assets/RegistrationAsset.php - asset for interactive form's fields hide/show actions</li>
<li>frontend/controllers/SiteController.php - modify actionIndex (display all SkyUser models), implement actionRegistration (main action for form)</li>
<li>frontend/models/RegistrationForm.php - form's model for data validation and saving</li>
<li>frontend/views/site/registration.php - main form's view file</li>
</ul>

## Preparing application

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Open a console terminal, execute the `init` command and select `dev` as environment.

   ```
   /path/to/php-bin/php /path/to/yii-application/init
   ```

   If you automate it with a script you can execute `init` in non-interactive mode.

   ```
   /path/to/php-bin/php /path/to/yii-application/init --env=Development --overwrite=All
   ```

2. Create a new database and adjust the `components['db']` configuration in `/path/to/yii-application/common/config/main-local.php` accordingly.

3. Open a console terminal, apply migrations with command `/path/to/php-bin/php /path/to/yii-application/yii migrate`.

4. Set document roots of your web server:

   - for frontend `/path/to/yii-application/frontend/web/` and using the URL `http://frontend.test/`
   - for backend `/path/to/yii-application/backend/web/` and using the URL `http://backend.test/`

<p> We'll need to use only frontend.test domain: http://frontend.test/index.php?r=site%2Fregistration - url for main actions
