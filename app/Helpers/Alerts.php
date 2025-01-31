<?php

namespace App\Helpers;

class Alerts
{
    public static function showAlert($alert)
    {      
        if (!empty($alert['title'])) {
            $alert = <<<HTML
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
            setTimeout(function () {
                Swal.fire({
                    title: "{$alert['title']}",
                    text: "{$alert['body']}",
                    icon: "{$alert['type']}"
                });
            }, 100);
            </script>
            HTML;
            echo $alert;
        }
    }
}