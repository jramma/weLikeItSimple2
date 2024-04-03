<?php

namespace App\Base;

class WordpressAdminTweaks extends Base
{
    function boot()
    {
        $this->addBodyClasses();
        $this->hideFieldsMarkedAsHidden();
        $this->hideTaxonomiesBuiltInDescriptions();
        $this->adminMenuCleanup();
        $this->adminBarCleanup();
        $this->addAdminMenuSeparator();
        $this->registerNavMenus();

        if (is_user_logged_in() && wp_get_current_user()->user_login == 'admin') {
            return;
        }

        $this->hideACF();
        // $this->hideBuiltInPosts();
        //$this->hideBuiltInPages();
        $this->hideWPUpdateNotices();
        $this->hideWPThemeSelection();
        $this->hideWPThemeAndPluginDashboard();
        $this->hidePermalinksSettings();
        $this->hideDashboardUpdate();
        $this->hidePlugins();
        $this->hideTools();
        $this->hideComments();
        $this->hideThemesAndPersonalization();
        $this->hideReadingOptions();
        $this->hideDashboard();
        $this->hideACF();
    }

    /**
     * Add classes to Body Class
     */
    private function addBodyClasses()
    {
        add_filter('body_class', function ($classes) {
            $classes[] = 'mortensen';
            return $classes;
        });
    }

    /**
     * Hide fields marked with class hide-this-field
     */
    private function hideFieldsMarkedAsHidden()
    {
        add_action('admin_head', function () {
            echo "
            <style>
            .hide-this-field {display:none;}
            </style>
        ";
        });
    }

    /**
     * Hide some taxonomies built in descriptions
     *
     */
    private function hideTaxonomiesBuiltInDescriptions()
    {
        add_action('admin_head', function () {
            echo "
    		<style>
                body.taxonomy-sector .term-description-wrap,
                body.taxonomy-country .term-description-wrap {
                    display:none;
                }
    		</style>
            ";
        });
    }

    /**
     * Admin menú cleanup
     */
    private function adminMenuCleanup()
    {
        add_action('admin_menu', function () {
            // remove_menu_page('edit.php');
            //remove_menu_page( 'edit.php?post_type=page' );
            remove_menu_page('edit-comments.php');
        });
    }

    /**
     * Admin bar cleanup
     */
    private function adminBarCleanup()
    {
        add_action(
            'admin_bar_menu',
            function () {
                global $wp_admin_bar;
                $wp_admin_bar->remove_node('wp-logo');
                $wp_admin_bar->remove_node('comments');
                $wp_admin_bar->remove_node('new-content');
                // $wp_admin_bar->remove_node('archive');
            },
            999
        );
    }

    /**
     * Add a separator to the admin menu
     */
    private function addAdminMenuSeparator()
    {
        add_action('admin_menu', function () {
            $positions = array(11, 40);

            foreach ($positions as $position) {
                global $menu;
                $index = 0;
                foreach ($menu as $offset => $section) {
                    if (substr(
                        $section[2],
                        0,
                        9
                    ) == 'separator') {
                        $index++;
                    }

                    if ($offset >= $position) {
                        $menu[$position] = array('', 'read', "separator{$index}", '', 'wp-menu-separator');
                        break;
                    }
                }
                ksort($menu);
            }
        });
    }

    /**
     * Register nav menus
     */
    private function registerNavMenus()
    {
        add_action('after_setup_theme', function () {
            register_nav_menus(array(
                'top_navigation' => __('Top Navigation', 'basics'),
                'primary_navigation' => __('Primary Navigation', 'basics'),
                'legal_navigation' => __('Legal Navigation', 'basics'),
            ));
        });
    }

    /**
     * Hide edit or create default posts from menu and block its use
     */
    private function hideBuiltInPosts()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit.php');
            remove_submenu_page('post-new.php', 'post-new.php');
        });
        add_action('wp_before_admin_bar_render', function () {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('new-post');
        });
        add_action('load-post-new.php', function () {
            if (get_current_screen()->post_type == 'post') {
                wp_die(__('Not allowed operation.', 'basics'));
            }
        });
    }

    /**
     * Hide edit or create default pages from menu and block its use
     */
    private function hideBuiltInPages()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit.php?post_type=page');
            remove_submenu_page('post-new.php?post_type=page', 'post-new.php?post_type=page');
        });
        add_action('wp_before_admin_bar_render', function () {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('new-page');
        });
        add_action('load-post-new.php', function () {
            if (get_current_screen()->post_type == 'page') {
                wp_die(__('Not allowed operation.', 'basics'));
            }
        });
    }

    /**
     * Hide WordPress update notices
     */
    private function hideWPUpdateNotices()
    {
        add_action('admin_head', function () {
            echo "
                <style>
                .update-nag {display:none;}
                </style>
            ";
        });
    }

    /**
     * Hides WordPress themes selection and other unused theme-related stuff
     */
    private function hideWPThemeSelection()
    {
        add_action('admin_head', function () {
            echo "
                 <style>
                 div#wpwrap div#wpcontent div#wpbody div#wpbody-content div.wrap div.theme-browser div.themes, div#wpwrap div#wpcontent div#wpbody div#wpbody-content .theme-count {display:none;}
                 </style>
            ";
        });
    }

    /**
     * Prevents the admin user from installing new themes and plugins
     */
    private function hideWPThemeAndPluginDashboard()
    {
        add_filter(
            'map_meta_cap',
            function ($caps, $cap) {
                if ($cap === 'install_plugins') {
                    $caps[] = 'do_not_allow';
                }
                if ($cap === 'install_themes') {
                    $caps[] = 'do_not_allow';
                }
                return $caps;
            },
            10,
            2
        );
    }

    /**
     * Remove the permalinks settings link
     */
    private function hidePermalinksSettings()
    {
        add_action(
            'admin_menu',
            function () {
                remove_submenu_page('options-general.php', 'options-permalink.php');
            },
            999
        );
    }

    /**
     * Hide dashboard Update submenu
     *
     * Hidden on porpuse via CSS so we can still access if we know the URL
     */
    private function hideDashboardUpdate()
    {
        add_action('admin_head', function () {
            echo "
                <style>
                li#menu-dashboard .wp-submenu, li#menu-dashboard .wp-submenu-wrap {display:none;}
                </style>
            ";
        });
    }

    /**
     * Hide Plugins from admin menu
     *
     * Hidden on porpuse via CSS so we can still access if we know the URL
     */
    private function hidePlugins()
    {
        add_action('admin_head', function () {
            echo "
                <style>
                li#menu-plugins {display:none;}
                </style>
            ";
        });
    }

    /**
     * Hide tools menu item in the admin dashboard
     */
    private function hideTools()
    {
        add_action('admin_menu', function () {
            remove_submenu_page('tools.php', 'tools.php');
            remove_submenu_page('tools.php', 'import.php');
            remove_submenu_page('tools.php', 'export.php');
            remove_submenu_page('tools.php', 'site-health.php');
            remove_menu_page('skyverge');
        });
    }

    /**
     * Hide comments menu item in the admin dashboard
     */
    private function hideComments()
    {
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });
    }

    /**
     * Hide themes and personalization menu item in the admin dashboard
     */
    private function hideThemesAndPersonalization()
    {
        add_action('admin_menu', function () {
            global $submenu;
            if (isset($submenu['themes.php'])) {
                foreach ($submenu['themes.php'] as $index => $menu_item) {
                    foreach ($menu_item as $value) {
                        if (strpos($value, 'customize') !== false) {
                            unset($submenu['themes.php'][$index]);
                        }
                    }
                }
            }
            remove_submenu_page('themes.php', 'themes.php');
        });
    }

    /**
     * Hide reading built-in WP options
     */
    private function hideReadingOptions()
    {
        add_action('admin_menu', function () {
            global $submenu;
            $options_to_hide = [
                'options-reading',
                'options-discussion',
            ];
            if (isset($submenu['options-general.php'])) {
                foreach ($submenu['options-general.php'] as $index => $menu_item) {
                    foreach ($menu_item as $value) {
                        foreach ($options_to_hide as $option_to_hide) {
                            if (strpos($value, $option_to_hide) !== false) {
                                unset($submenu['options-general.php'][$index]);
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * Hide admin dashboard and create custom panel
     */
    private function hideDashboard()
    {
        /**
         * Remove WP-Admin Dashboard widgets
         */
        add_action(
            'wp_dashboard_setup',
            function () {
                global $wp_meta_boxes;
                unset($wp_meta_boxes['dashboard']);
                remove_action('welcome_panel', 'wp_welcome_panel');
            },
            99
        ); //priority is relevant here, do not edit without editing "Add a custom dashboard widget" to a higher number

        /**
         * Add a custom dashboard widget
         */
        add_action(
            "wp_dashboard_setup",
            function () {
                wp_add_dashboard_widget(
                    'basics-dashboard',
                    __('Admin dashboard for ', 'basics') . get_bloginfo('name'),
                    function () {
                        echo "
                    <p>" . __('Admin dashboard for ', 'basics') . get_bloginfo('name') . "
                    <p>" . __('v1.0', 'basics') . "
                    ";
                    }
                );
            },
            100
        ); //priority is relevant here, do not edit without editing "Remove WP-Admin Dashboard widgets" to a lower number
    }

    /**
     * Hide advanced custom fields menu item in the admin dashboard
     */
    private function hideACF()
    {
        add_filter('acf/settings/show_admin', '__return_false');
    }
}

new WordpressAdminTweaks();
