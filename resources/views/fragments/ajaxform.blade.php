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
            var form_id = this.form_id;
            var message;

            if(this.opt.function_error instanceof Function) {
                var result = this.opt.function_error(context.responseJSON, this);
                if(typeof result !== 'undefined') {
                    return result;
                }

            }

            $.each(context.responseJSON.errors, function (key, value){
                $('#'+form_id+' [name="'+key+'"]').addClass('has-error').attr('placeholder', value[0]);
                message += value[0]+'\n';
            });
            this.always(this);
        }

        always(context) {
            $('#'+context.form_id+' input,textarea,select,button').attr('disabled', false);
        }

        preSubmit(formData, jqForm, options) {
            this.form_id = jqForm[0].id;

            if(this.opt.function_pre instanceof Function) {
                var result = this.opt.function_pre(this);
                if(typeof result !== 'undefined') {
                    return result;
                }
            }

            $('#'+this.form_id+' input,textarea,select').removeClass('has-error');
            $('#'+this.form_id+' input,textarea,select,button').attr('disabled', true);
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
                $('#'+this.form_id+' input,textarea,select').not('input[name="_token"]').val('');
                this.always(this);
            }
        }

        static ready(form_tag, opt) {
            var obj = new ajaxform();
            opt.always = function (context) {
                return obj.always(context);
            }
            return obj.ajaxform(form_tag, opt);
        }

    }

</script>