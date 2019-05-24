$(function(){

    var formSelector = 'form[name=registration_form]';

    (function formInit($form){

        $form.on('input change', '.is-invalid', function(){
            $(this).removeClass('is-invalid').closest('.form-group').find('.invalid-feedback').remove();
        });

        var $btn = $('.btn', $form);

        $form.submit(function(e){

            e.preventDefault();
            var form = this;

            var $spiner = $('<div class="spinner-border text-primary" />').insertAfter($btn);
            $btn.prop('disabled', true);

            $.ajax({
                url: form.action,
                type: form.method,
                contentType: false,
                data: new FormData(form),
                processData: false,
                success: function (registrationForm) {
                    formInit($(registrationForm).replaceAll($form));
                    $btn.prop('disabled', false);
                    $spiner.remove();
                }
            });

        });

    })($(formSelector))

});