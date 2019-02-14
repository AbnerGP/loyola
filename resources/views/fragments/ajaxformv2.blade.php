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

        always(context, boolean) {
            // console.log('Call always'+ context.form_tag);
            var form = $(context.form_tag);
            $.each(form[0], function(key, value) {
                var element = $(value);
                element.attr('disabled', boolean);
            });
            //$('#'+context.form_id+' input,textarea,select,button').attr('disabled', false);
        }

        preSubmit(formData, jqForm, options) {
            this.form_id = jqForm[0].id;
            this.form_tag = '#'+this.form_id;
            this.form_element = $(this.form_tag);

            this.disabled = function(context, boolean) {
                return this.opt.always(context, boolean);
            };
            this.clean = function(context) {
                $.each(context.form_element[0], function(key, value) {
                    var element = $(value);
                    element.val('');
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

            this.always(this, true);
            return true;
        }

        postSubmit(data, statusText, xhr, $form)  {
            if(this.opt.function_success instanceof Function) {
                var result = this.opt.function_success(data, this);
                if(typeof result !== 'undefined') {
                    return result;
                }
            }
            if(data.status === true) {
                alert(data.message);
                $('#'+this.form_id+' input,textarea,select').not('input[name="_token"]').val('');
            }
            else {
                alert('other error');
            }
            this.always(this, false);
        }

        static ready(form_tag, opt) {
            var obj = new ajaxform();
            opt.always = function (context, boolean) {
                return obj.always(context, boolean);
            };
            return obj.ajaxform(form_tag, opt);
        }

    }

</script>