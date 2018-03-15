<?php
    namespace backend\components;
    use backend\models\Dealers;
use Yii;

    class Helpers {
        public static function GeneratePassword() {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = substr( str_shuffle( $chars ), 0, 8 );
            return $password;
        }

        public static function CheckAuth($type, $link) {
            if (Yii::$app->session->get('profile_auth') == "OK" AND Yii::$app->session->get('profile_ip') == $_SERVER['REMOTE_ADDR']) {
                $auth = true;
            } else {
                $auth = false;
            }
            if ($type == "redirect") {
                if ($auth == true) {
                    return Yii::$app->response->redirect($link);
                }
            } else if ($type == "no-redirect") {
                if ($auth == false) {
                    return Yii::$app->response->redirect("/profile/authentication/");
                }
            } else if ($type == "check") {
                return $auth;
            }
        }

        public static function SetBack($page) {
            $backs = Yii::$app->session->get('navigation_back');
            $backs[] = $page;
            return $backs;
        }

        public static function GetConfig($table, $type) {
            $array = null;
            switch ($table) {
                case "admins":
                    $array = array (
                        'select_fields' => ['id', 'fio', 'position', 'email', 'phone', 'status', 'last_edit', 'created', 'avatar'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                        ),
                    );
                    break;

                case "dealers":
                    $array = array (
                        'select_fields' => ['id', 'name', 'company', 'fio', 'email', 'phone', 'status', 'last_edit', 'created', 'avatar'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                        ),
                    );
                    break;

                case "sellers":
                    $array = array (
                        'select_fields' => ['id', 'fio', 'seller_type', 'company', 'city', 'email', 'phone', 'status', 'last_edit', 'created', 'avatar'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                            'seller_type' => array (
                                'label' => 'Тип продавца',
                                'type' => 'static',
                                'icon' => 'icon-reading',
                                'data' => array(
                                    'f' => 'Физ. лицо',
                                    'u' => 'Юр. лицо',
                                    'i' => 'ИП'
                                )
                            ),
                            'dealer' => array (
                                'label' => 'Дилер',
                                'type' => 'hidden',
                                'icon' => 'icon-man-woman',
                            ),
                        ),
                        'access' => array (
                            'key' => 'rod_id',
                        )
                    );
                    break;

                case "shops":
                    $array = array (
                        'select_fields' => ['shop_id', 'city_id', 'shop_name', 'shop_min_price', 'shop_contacts', 'status', 'last_edit', 'created', 'shop_img'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                            'seller' => array (
                                'label' => 'Продавец',
                                'type' => 'hidden',
                                'icon' => 'icon-reading',
                            ),
                        ),
                        'access' => array (
                            'key' => 'user_id',
                        )
                    );
                    break;

                case "products":
                    $array = array (
                        'select_fields' => ['id', 'product_name', 'status', 'last_edit', 'created', 'product_main_img', 'product_price'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                            'shop' => array (
                                'label' => 'Магазин',
                                'type' => 'hidden',
                                'icon' => 'icon-store2',
                            ),
                        ),
                        'access' => array (
                            'key' => 'user_id',
                        )
                    );
                    break;
                case "params":
                    $array = array (
                        'select_fields' => ['id', 'name', 'status', 'last_edit', 'created'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                        ),
                    );
                    break;
                case "users":
                    $array = array (
                        'select_fields' => ['id', 'username', 'email', 'phone', 'address', 'last_edit', 'date'],
                    );
                    break;
                case "orders":
                    $array = array (
                        'select_fields' => ['id', 'count', 'overall_summ', 'address', 'description', 'mobile_user_id', 'shop_id', 'status', 'updated_date', 'created_date'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '10' => 'В обработке',
                                    '0' => 'Отказано',
                                    '1' => 'Обработан'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                        ),
                    );
                    break;
                case "cities":
                    $array = array (
                        'select_fields' => ['id', 'country_id', 'name', 'status', 'last_edit', 'created'],
                        'filtr' => array (
                            'status' => array (
                                'label' => 'Статус',
                                'type' => 'static',
                                'icon' => 'icon-check',
                                'data' => array(
                                    '1' => 'Активный',
                                    '0' => 'Неактивный'
                                )
                            ),
                            'created' => array (
                                'label' => 'Создание',
                                'type' => 'date',
                                'icon' => 'icon-calendar'
                            ),
                        ),
                    );
                    break;
                default:
                    $array = null;
                    break;
            }
            return $array[$type];
        }

        public static function GetRangeAccess($roles) {
            if (in_array(Yii::$app->session->get('profile_role'), $roles)) {
                $access = true;
            } else {
                $access = false;
            }
            return $access;
        }

        public static function GetPageAccess($page) {
            $array = array (
                'admins' => array (
                    'superadmin'
                ),
                'dealers' => array (
                    'superadmin',
                    'admin',
                ),
                'sellers' => array (
                    'superadmin',
                    'admin',
                    'dealer'
                ),
                'shops' => array (
                    'superadmin',
                    'admin',
                    'dealer',
                    'seller'
                ),
                'products' => array (
                    'superadmin',
                    'admin',
                    'dealer',
                    'seller'
                ),
                'geo' => array (
                    'admin'
                ),
                'account' => array (
                    'superadmin',
                    'admin',
                    'dealer',
                    'shops',
                    'seller',
                ),
                "sections" => array (
                    'superadmin',
                ),
                "params" => array (
                    'superadmin'
                ),
                "users" => array (
                    'superadmin'
                ),
                'orders' => array (
                    'superadmin',
                    'admin',
                    'dealer',
                    'seller'
                ),
                'cities' => array (
                    'superadmin'
                ),
                'about' => array (
                    'superadmin'
                ),
                'stats-dealers' => array (
                    'superadmin',
                    'admin'
                ),
                'stats-sellers' => array (
                    'superadmin',
                    'admin',
                    'dealers'
                ),
                'stats-shops' => array (
                    'superadmin',
                    'admin',
                    'dealers',
                    'sellers'
                ),
                'stats-users' => array (
                    'superadmin',
                    'admin',
                ),
            );
            if (in_array(Yii::$app->session->get('profile_role'), $array[$page])) {
                $access = true;
            } else {
                $access = false;
            }
            return $access;
        }

        public static function GetTransliterate($s) {
            $s = (string) $s;
            $s = strip_tags($s);
            $s = str_replace(array("\n", "\r"), " ", $s);
            $s = preg_replace("/\s+/", ' ', $s);
            $s = trim($s);
            $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
            $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
            $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
            $s = str_replace(" ", "-", $s);
            return $s;
        }
    }
?>
