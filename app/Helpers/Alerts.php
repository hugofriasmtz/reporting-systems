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
    
    public static function DeleteAlert()
    {

        $alertScript = <<<HTML
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
        setTimeout(function () {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
    
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
        }, 100);
        </script>
        HTML;
        echo $alertScript;
    }
}