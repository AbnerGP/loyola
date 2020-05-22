<?php
/**
 * Created by PhpStorm.
 * User: Abner Gorostieta
 * Date: 28/05/2019
 * Time: 10:24 AM
 */

function currentUser()
{
    return auth()->user();
}

function currentRole()
{
    return currentUser()->roles()->first()->title;
}

function currentRoleName() {
    return currentUser()->roles()->first()->name;
}

function superadminRole() {
    return 'superadmin';
}

function currentTemplate()
{
    return Config('constants.template_admin');
}

function templateRoute($route)
{
    if(currentTemplate() != 'default' || currentTemplate() != ''){
        $path = 'themes/'.currentTemplate().'/'.$route;
        $file = base_path() . '/public/' . $path;
        $url = url('themes/'.currentTemplate().'/'.$route);

        if(file_exists($file)){
            return $url;
        }
    }

    return defaultTemplateRoute($route);
}

function defaultTemplateRoute($route)
{
    return url('themes/default/'.$route);
}

function tRoute($route) {
    return templateRoute($route);
}

function templateView($view)
{
    $exp = explode('.', $view);
    if(currentTemplate() != null){
        $view_concat = $exp[0] . '.' . currentTemplate();
        for($i = 1; $i < count($exp); $i++){
            $view_concat .= '.' . $exp[$i];
        }

        if(view()->exists($view_concat) === true)
            return $view_concat;
    }

    return $view;
}

function tView($view) {
    return view(templateView($view));
}

/**
 * @return App\Objects\Interfaces\Settings
 */
function settings()
{
    return app(\App\Objects\Interfaces\Settings::class);
}

/**
 * Return nav-here if current path begins with this path.
 *
 * @param string $path
 * @return string
 */
function setActive($route)
{
    $path = str_replace(url('') . '/', '', route($route));
    return Request::is($path . '*') ? ' active' :  '';
}

function invitationQR($uuid) {
    return \QrCode::format('png')->size(350)->margin(1)->merge('/public/mail/morelos1.png', .3)->errorCorrection('H')->generate($uuid);
}

/**
 * Devuelve las carpetas que estén dentro de resources/views/mail
 * @return array
 */
function mail_templates() {
    $dir = 'resources/views/mail';
    $path = base_path($dir);
    $files = scandir($path);
    $folders = [];

    foreach ($files as $file) {
        if(is_dir(base_path("$dir/$file")) && $file != '.' && $file != '..')
            $folders[$file] = $file;
    }

    return $folders;
}