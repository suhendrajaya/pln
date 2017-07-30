<?php
return array(
    /*
      |--------------------------------------------------------------------------
      | Inherit from another theme
      |--------------------------------------------------------------------------
      |
      | Set up inherit from another if the file is not exists,
      | this is work with "layouts", "partials", "views" and "widgets"
      |
      | [Notice] assets cannot inherit.
      |
     */

    'inherit' => null, //default

    /*
      |--------------------------------------------------------------------------
      | Listener from events
      |--------------------------------------------------------------------------
      |
      | You can hook a theme when event fired on activities
      | this is cool feature to set up a title, meta, default styles and scripts.
      |
      | [Notice] these event can be override by package config.
      |
     */
    'events' => array(
        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme) {
            // You can remove this line anytime.
            $theme->asset()->writeScript('inline-script', '
                    var baseUrl = "' . route('homepage') . '";
                    
                ');
            $theme->setTitle('Copyrights © 2017 PT. PLN (Persero) All Rights Reserved');

            // Breadcrumb template.
            // $theme->breadcrumb()->setTemplate('
            //     <ul class="breadcrumb">
            //     @foreach ($crumbs as $i => $crumb)
            //         @if ($i != (count($crumbs) - 1))
            //         <li><a href="{{ $crumb["url"] }}">{!! $crumb["label"] !!}</a><span class="divider">/</span></li>
            //         @else
            //         <li class="active">{!! $crumb["label"] !!}</li>
            //         @endif
            //     @endforeach
            //     </ul>
            // ');
        },
        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme) {

            $theme->asset()->container('footer')->usePath()->add('js_jquery', 'vendors/jquery/dist/jquery.min.js');
            $theme->asset()->container('footer')->usePath()->add('js_bootstrap', 'vendors/bootstrap/dist/js/bootstrap.min.js');
            $theme->asset()->container('footer')->usePath()->add('js_fastclick', 'vendors/fastclick/lib/fastclick.js');
            $theme->asset()->container('footer')->usePath()->add('js_nprogress', 'vendors/nprogress/nprogress.js');
            $theme->asset()->container('footer')->usePath()->add('js_icheck', 'vendors/iCheck/icheck.min.js');
            $theme->asset()->container('footer')->usePath()->add('js_moment', 'vendors/moment/min/moment.min.js');
            $theme->asset()->container('footer')->usePath()->add('js_bootbox', 'vendors/bootbox/bootbox.min.js');
            $theme->asset()->container('footer')->usePath()->add('js_daterangepicker', 'vendors/bootstrap-daterangepicker/daterangepicker.js');
            $theme->asset()->container('footer')->usePath()->add('js_global', 'js/global.js');
            $theme->asset()->container('footer')->usePath()->add('js_custom', 'js/custom.min.js');
//            $theme->asset()->container('footer')->usePath()->add('js_custom', 'js/custom.js');

            // You may use this event to set up your assets.
            // $theme->asset()->usePath()->add('core', 'core.js');
            // $theme->asset()->add('jquery', 'vendor/jquery/jquery.min.js');
            // $theme->asset()->add('jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', array('jquery'));
            // Partial composer.
            // $theme->partialComposer('header', function($view)
            // {
            //     $view->with('auth', Auth::user());
            // });
        },
        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(
            'login' => function($theme) {

                $theme->asset()->usePath()->add('css_bootstrap', 'vendors/bootstrap/dist/css/bootstrap.min.css');
                $theme->asset()->usePath()->add('css_font_awesome', 'vendors/font-awesome/css/font-awesome.min.css');
                $theme->asset()->usePath()->add('css_nprogress', 'vendors/nprogress/nprogress.css');
                $theme->asset()->usePath()->add('css_icheck', 'vendors/iCheck/skins/flat/green.css');
                $theme->asset()->usePath()->add('css_custome', 'css/custom.min.css');

                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            },
            'home' => function($theme) {

                $theme->asset()->usePath()->add('css_bootstrap', 'vendors/bootstrap/dist/css/bootstrap.min.css');
                $theme->asset()->usePath()->add('css_font_awesome', 'vendors/font-awesome/css/font-awesome.min.css');
                $theme->asset()->usePath()->add('css_nprogress', 'vendors/nprogress/nprogress.css');
                $theme->asset()->usePath()->add('css_icheck', 'vendors/iCheck/skins/flat/green.css');
                $theme->asset()->usePath()->add('css_daterangepicker', 'vendors/bootstrap-daterangepicker/daterangepicker.css');
                $theme->asset()->usePath()->add('css_custome', 'css/custom.min.css');
                $theme->asset()->usePath()->add('css_table', 'css/table.css');

                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            }
        )
    )
);
