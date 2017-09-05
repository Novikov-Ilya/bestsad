------------------------------------------------------------------------------
                            YANDEX.METRICS MODULE
------------------------------------------------------------------------------


The Yandex.Metrica [1] service is European alternative of Google Analytics.

The Yandex.Metrics project helps to integrate a website with the Yandex.Metrica [1].

Since version 7.x-2.x project consists of two modules.

* Yandex.Metrics Counter module
    Features:
        * Installing Yandex.Metrica counter code on site
        * Configuring visibility of the counter
    Dependencies
        * NO DEPENDENCIES! Just enable and use.

* Yandex.Metrics Reports module
    Note:
        The Yandex.Metrica API [2] is used for communication with Yandex.Metrica service.
    Features:
        * Authorizing of your site on Yandex services (through oAuth 2.0)
        * Reports and charts:
            * Page Views, Visitors, New Visitors
            * Traffic Sources
            * Popular Search Phrases
            * Popular Content
            * Geography of Visits
            * Hourly Traffic
            * Demography of Visits
        * Block with popular content links (Views module is used)
    Dependencies
        * Yandex.Metrics Counter module
        * Google chart API [3]
        * Views [4]
        * [Optional] For support of internationalized domain names
          download idna_convert class [5] of Matthias Sommerfeld and copy it
          into the 'sites/all/libraries/idna_convert/' or 'sites/name_of_your_site/libraries/idna_convert/'
          folder of your Drupal setup.

Available interface translations
Russian (Русский)



INSTALLING
------------------------------------------------------------------------------
1. Backup your database.

2. Make sure you resolved dependencies of modules. If you are going to use Yandex.Metrics Reports module
   please install Google chart API [3] and Views [4] modules first.

3. If you use internationalized domain name you should download PHP file idna_convert.class.php
   of Matthias Sommerfeld from [5] and copy it into the 'sites/all/libraries/idna_convert/' or
   'sites/name_of_your_site/libraries/idna_convert/' folder of your Drupal setup.

4. Copy the complete 'yandex_metrics/' directory into the 'sites/all/modules/',
   'sites/default/modules' or 'sites/name_of_your_site/modules' folder of 
   your Drupal setup. 
   More information about installing contributed modules could be found at 
   "Install contributed modules" (http://drupal.org/node/70151)

5. Enable necessary modules in "Yandex.Metrics" section of module administration page
   (Administration >> Modules).

6. Configure modules (see "CONFIGURATION" below).



UPDATING
------------------------------------------------------------------------------
1. Verify that the version you are going to upgrade contains all the features
   you are using in your Drupal setup. Some features could have been removed
   or replaced by others.

2. Read carefully in the project issue tracking about upgrade paths problems
   before you start the upgrade process.

3. Backup your database.

4. Update current module code with latest recommended version. Previous versions
   could have bugs already reported and fixed in the last version.

5. Complete the update process, set maintenance mode, call the update.php script 
   and finish the update operation.
   For more information please go to: http://groups.drupal.org/node/19513

6. Verify your module configuration and check that the features you are using
   work as expected. Also verify that all required modules are enabled, and
   permissions are set as desired.

Note: whenever you have the chance, try an update in a local or development
      copy of your site.


CONFIGURATION
------------------------------------------------------------------------------
* Yandex.Metrics Counter module
    1. On the access control administration page ("Administration >> People >> Permissions")
       you need to assign:

        *	"Administer Yandex.Metrics Settings" permission to the roles that are allowed
            to administer the Yandex.Metrics settings.

    2. Create Yandex.Metrica [1] account.

       Please skip this step if you have already had it.

    3. Create Yandex.Metrica counter for your site at Yandex.Metrica admin interface.

       Note: We recommend to create simple counter without any widget
             but counter code with widget is acceptable.

       Generate and save this Javascript code for later usage.

       Please skip this step if you have already created a counter.

    4. Go to the module settings page ("Administration >> Configuration >> System >> Yandex.Metrics")
       Users need the "Administer Yandex.Metrics Settings" permission to access to this page.

       Paste Javascript code of counter from Yandex.Metrica to the Counter Code text field
       on the Counter Code settings page.
       You can also define counter code visibility settings.
       Then submit form.
       By this step you add counter code to the footer of permitted pages of your site.

       Please skip this step if you have already added Yandex.Metrica counter code on your site pages
       through another way.

       Please skip next steps if you need nothing except installation of the counter code.


* Yandex.Metrics Reports module
    1. On the access control administration page ("Administration >> People >> Permissions")
       you need to assign:

        *   "Access Yandex.Metrics report" permission to the roles that are allowed
            to view Yandex.Metrics Summary Report

    2. Register your Yandex application. Use Yandex step-by-step guide [6]
       to perform this step.

       Enter Callback URI for your Yandex application.
       Callback URI: http://YOUR_SITE_HOST_NAME/yandex_metrics/oauth

       Save your application Client ID and Client Secret for later usage.

    3. Application authorization.
       Go to Authorization tab (Administration >> Configuration >> System >> Yandex.Metrics >> Authorization)
       and paste application Client ID and Client Secret into the corresponding fields.
       Then press Authorise Application button to submit form.

       You will be redirected to the special Yandex page.
       You should confirm your application authorization on that page.
       Enter your Yandex login and password if it will be necessary.

       Then your will be redirected back to the settings page of the Yandex.Metrics module on your site
       and get success message.

    4. Reports settings
       Go to Reports tab (Administration >> Configuration >> System >> Yandex.Metrics >> Reports)
       to enable or disable some of the reports.

    5. Check Yandex.Metrics Summary Report content
       ("Administration >> Reports >> Yandex.Metrics Summary Report").
       To access this page users need the "Access Yandex.Metrics report" permission.
       Note:
         Your report can be empty if you have just created Yandex.Metrics counter
         and placed it to your site. Probably statistic information have not been collected yet.
         Please try again later.

    6. After successful module installation and configuration, you will be able to enable "Popular content (Yandex.Metrics)" block.
       This block shows popular content pulled from Yandex.Metrica as a list of links.

       To enable module go to ("Administration >> Structure >> Blocks")

       To configure block settings you can change "Popular content" view ("Administration >> Structure >> Views")

    7. The module uses CRON [7] for fetching data for "Popular Content" view from Yandex.Metrica.
       Go to Cron settings page (Administration >> Configuration >> System >> Yandex.Metrics >> Cron)
       to configure some settings.


DEVELOPMENT
------------------------------------------------------------------------------
Read how to write own plugins for Yandex.Metrics Reports module in yandex_metrics_reports/API.txt .


BUGS AND SHORTCOMINGS
------------------------------------------------------------------------------
* See the list of project issues [8].


CREDITS
------------------------------------------------------------------------------
Maintainers: Konstantin Komelin [9], Kate Marshalkina [10]
Original idea: Konstantin Komelin [9], Alex Sorokin [11]
Contributor list: [12]
Thanks all great guys who contributed to the project!


LINKS
------------------------------------------------------------------------------
[1] http://metrica.yandex.com/
[2] http://api.yandex.com/metrika/
[3] http://drupal.org/project/chart
[4] http://drupal.org/project/views
[5] http://www.phpclasses.org/browse/file/5845.html
[6] http://api.yandex.com/oauth/doc/dg/tasks/register-client.xml
[7] http://drupal.org/cron
[8] http://drupal.org/project/issues/yandex_metrics
[9] http://drupal.org/user/1195752
[10] http://drupal.org/user/1399638
[11] http://drupal.org/user/108088
[12] http://drupal.org/node/1180284/committers
