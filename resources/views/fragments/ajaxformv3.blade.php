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
            this.always(this, false);
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
                    alert('marcada como indefinida');
                }
                $.each(this.form_element[0], function(key, value) {
                    var element = $(value);
                    if( !(element.is('select')) || (element.attr('name') ==="_token")) {
                        if(($.inArray(element.prop('name'), except) === -1)) {
                            element.val('');
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

</script>