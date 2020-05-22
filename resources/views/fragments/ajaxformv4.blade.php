<script src="{{ asset('js/ajaxform.js') }}"></script>
<script>
    class ajaxform {
        ajaxform(form_tag, opt) {
            var options = {
                beforeSubmit: this.preSubmit,
                success: this.postSubmit,
                error: this.isError,
                opt: opt,
                always: opt.always,
            };
            $(form_tag).ajaxForm(options);
        }

        isError(context) {
            var message = '';
            var form = $(this.form_tag);

            if(this.opt.function_error instanceof Function) {
                var result = this.opt.function_error(context.responseJSON, this);
                if(typeof result !== 'undefined') {
                    return result;
                }

            }

            $.each(context.responseJSON.errors, function (key, value){

                $.each(form[0], function(key2, value2) {
                    var element = $(value2);
                    if(element.attr('name') === key) {
                        element.addClass('has-error').attr('placeholder', value[0]);
                    }
                });

                //$(this.form_tag+' [name="'+key+'"]').addClass('has-error').attr('placeholder', value[0]);
                message += value[0]+'\n';
            });
            alert(message);
            this.disabled(false);
            //this.always(this, false);
        }

        preSubmit(formData, jqForm, options) {
            this.form_id = jqForm[0].id;
            this.form_tag = '#'+this.form_id;
            this.form_element = $(this.form_tag);

            this.disabled = function(boolean, except) {
                if(typeof except === 'undefined') {
                    except = [];
                }

                var form = $(this.form_tag);
                $.each(form[0], function(key, value) {
                    var element = $(value);
                    if($.inArray(element.prop('name'), except) === -1) {
                        element.attr('disabled', boolean);
                    }
                });
            };

            this.clean = function(except) {
                if(typeof except === 'undefined') {
                    except = [];
                    // alert('marcada como indefinida');
                }
                $.each(this.form_element[0], function(key, value) {
                    var element = $(value);
                    if(!(element.prop('name') === "_token")) {
                        if(!(element.is('select'))) {
                            if(($.inArray(element.prop('name'), except) === -1)) {
                                console.log(element.prop('name'));
                                element.val('');
                            }
                        }
                    }
                });
            };



            if(this.opt.function_pre instanceof Function) {
                var result = this.opt.function_pre(this);
                if(typeof result !== 'undefined') {
                    return result;
                }
            }


            $.each(this.form_element[0], function (key, value) {
                var element = $(value);
                element.removeClass('has-error');
                console.log('remove!');
            });

            this.disabled(true);
            return true;
        }

        postSubmit(data, statusText, xhr, $form)  {
            if(this.opt.function_success instanceof Function) {
                var result = this.opt.function_success(data, this);
                if(typeof result !== 'undefined') {
                    return result;
                }
            }
            this.disabled(false);
        }

        static ready(form_tag, opt) {
            var obj = new ajaxform();
            return obj.ajaxform(form_tag, opt);
        }

    }

    /* ======= DELETE WITH SWEET ALERT ====== */

    function ConfirmDelete(id, route, text = false, reload = false)
    {
        if(text) {
            swal({
                title: "¿Estás seguro?",
                text: "Escribe la palabra BORRAR (en mayúsculas) para eliminar el registro permanentemente.",
                type: "input",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sí. Eliminar.",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function (inputValue) {
                if(inputValue === 'BORRAR') {
                    deleteItem(id, route, reload);
                } else {
                    swal.showInputError("Palabra incorrecta.");
                    return false;
                }
            });
        } else {
            swal({
                title: "¿Estás seguro?",
                text: "Este registro se eliminará permanentemente.",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sí. Eliminar.",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                deleteItem(id, route, reload);
            });
        }
    }

    function deleteItem(id, route, reload) {
        swal({
            title: "Enviado...",
            text: "Espere porfavor",
            imageUrl: '{{ url('default/loader.gif') }}',
            showConfirmButton: false,
            allowOutsideClick: false
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            url: route,
            success:function(data){
                if(data.success) {
                    swal({title:"Eliminado", text:data.message, type:"success"}, function () {
                        if(reload)
                            location.reload();
                        else
                            $('#row_' + id).remove();
                    });
                }else{
                    swal("Error", data.message, "error");
                }
            },
            error:function(data, context){
                $.each(data.responseJSON.errors, function(key, value) {
                    console.log(value);
                });
            }
        });
    }


</script>