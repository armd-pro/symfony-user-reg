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
                success: function (resp)
                {
                    if(!resp.success)
                    {
                        $('.is-invalid', resp.form).each(function(i, field){

                            var $row = $(field).closest('.form-group').replaceAll(
                                $('#' + field.id, $form).closest('.form-group')
                            );

                            if(field.type === 'password') {
                                $row.next().find('[type=password]').val('');
                            }
                        });
                    }
                    else
                    {
                        formInit($(resp.form).replaceAll($form));
                    }

                    $btn.prop('disabled', false);
                    $spiner.remove();
                }
            });

        });

    })($(formSelector))

});