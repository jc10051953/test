<?php
/**
 * Класс для работы с API
 *
 * @author		jc
 * @version		v.1.0 (26/03/2025)
 */
class Api
{
    public function __construct()
    {
    }

    /**
     * Заполняет строковый шаблон template данными из объекта object
     *
     * @author		jc
     * @version		v.1.0 (26/03/2025)
     * @param		array $array
     * @param		string $template
     * @return		string
     */
    public function get_api_path(array $array, string $template) : string
    {
        // Заменяем плейсхолдеры в шаблоне на соответствующие значения из массива
        foreach ($array as $key => $value) {
            $template = str_replace('%' . $key . '%', urlencode($value), $template);
        }

        return $template;
    }
}

$user = [
    'id'    => 20,
    'name'  => 'John Dow',
    'role'  => 'QA',
    'salary'=> 100
];

$api_path_templates = [
    "/api/items/%id%/%name%",
    "/api/items/%id%/%role%",
    "/api/items/%id%/%salary%"
];

$api = new Api();

$api_paths = array_map(function ($api_path_template) use ($api, $user) {
    return $api->get_api_path($user, $api_path_template);
}, $api_path_templates);

echo json_encode($api_paths, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);