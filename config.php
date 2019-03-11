<?php
/*
 * ---------------------------------------------------------------------------------
 * Main Mido Configuration Settings
 * ---------------------------------------------------------------------------------
 */
return array(
    /*
     * ---------------------------------------------------------------------------------------
     * The Template configuration  used by the application is returned here.
     * Use this settings to define the current template to use
     * ---------------------------------------------------------------------------------------
     */
    'template' => array(
        'name' => 'mido',
        //'template_path' => 'Mido/School',   // custom template path. Default is template name
        'multi_template' => false,    // change to true to use multiple template for switch
        'switch_pattern' => array(
            /*
             * You must define switch pattern when using multi_template
             * indicate each switch pattern to match corresponding template
             * The template you are using in each pattern does not necessarily
             * have to be the main template you have defined for your application
             * For example, you could use a different template entirely from the Mido
             * template used above. That means I could use a template named Fancy as part
             * of my application, despite using Mido as the global template. You can define as
             * many  switch with their corresponding templates as possible.
             *
             */
            array(
                'switch' => '/shop',
                'template_path' => 'fancy/shop/'
            ),
            array(
                'switch' => '/offers',
                'template_path' => 'mido/promotions/'
            ),
        ),
        /*
         * Additional settings. uncomment to use
         * 'multi_template' => true,    // default is false
         custom_path'=>'Template/Mido'   // custom template path
         */
    ),
    /*
     * Language configuration starts here. Use this option to define the application language
     */
    'language' => array(
        'name' => "English America",
        'iso' => 'en-us',
    ),
    /*
     * This section the function that loads all the application classes and make them ready for usage
     * Please do not edit this section of your configuration file, or your application might not load
     */
);
