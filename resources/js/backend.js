/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 $().ready(function(){

    formValidator($('#form-create'));
    formValidator($('#form-edit'));

    function formValidator(form){
        form.submit(function(event){
            let errors = false;
            $('#error-name').hide();
            $('#error-rooms').hide();
            $('#error-beds').hide();
            $('#error-bathrooms').hide();
            $('#error-dimentions').hide();
            $('#error-address').hide();
            $('#error-city').hide();
            $('#error-description').hide();
            $('#error-image').hide();
            $('#error-price').hide();

            // Campo name
                if($('#name').val().length === 0){
                    $('#error-name').show('slow').text('Il campo nome è obbligatorio').fadeOut(10000);
                    $('#name').addClass('is-invalid');
                    errors = true;
                }
                else if($('#name').val().length < 3){
                    $('#error-name').show('slow').text('Il campo nome deve avere minimo 3 caratteri').fadeOut(10000);
                    $('#name').addClass('is-invalid');
                    errors = true;
                }
                else if($('#name').val().length > 255){
                    $('#error-name').show('slow').text('Il campo nome può avere massimo 50 caratteri').fadeOut(10000);
                    $('#name').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#name').removeClass('is-invalid')
                }
            //
            // Campo rooms
                if(isNaN($('#rooms').val())){
                    $('#error-rooms').show('slow').text('Il campo numero di stanze deve essere un numero').fadeOut(10000);
                    $('#rooms').addClass('is-invalid');
                    errors = true;
                }
                else if($('#rooms').val() > 25){
                    $('#error-rooms').show('slow').text('Non puoi registrare un appartamento con più di 25 stanze').fadeOut(10000);
                    $('#rooms').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#rooms').removeClass('is-invalid')
                }
            //
            // Campo beds
                if(isNaN($('#beds').val())){
                    $('#error-beds').show('slow').text('Il numero di letti deve essere un numero').fadeOut(10000);
                    $('#beds').addClass('is-invalid');
                    errors = true;
                }
                else if($('#beds').val() > 25){
                    $('#error-beds').show('slow').text('Non puoi registrare un appartamento con più di 25 letti').fadeOut(10000);
                    $('#beds').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#beds').removeClass('is-invalid')
                }
            //
            // Campo bathrooms
                if(isNaN($('#bathrooms').val())){
                    $('#error-bathrooms').show('slow').text('Il numero dei bagni deve essere un numero').fadeOut(10000);
                    $('#bathrooms').addClass('is-invalid');
                    errors = true;
                }
                else if($('#bathrooms').val() > 25){
                    $('#error-bathrooms').show('slow').text('Non puoi registrare un appartamento con più di 25 bagni').fadeOut(10000);
                    $('#bathrooms').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#bathrooms').removeClass('is-invalid')
                }
            //
            // Campo dimentions
                if(isNaN($('#dimentions').val())){
                    $('#error-dimentions').show('slow').text('Le dimensioni devono essere un numero').fadeOut(10000);
                    $('#dimentions').addClass('is-invalid');
                    errors = true;
                }
                else if($('#dimentions').val() < 10){
                    $('#error-dimentions').show('slow').text('Non puoi registrare un appartamento con meno di 10 mq').fadeOut(10000);
                    $('#dimentions').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#dimentions').removeClass('is-invalid')
                }
            //
            // Campo address
                if($('#address').val().length === 0){
                    $('#error-address').show('slow').text('Il campo indirizzo è obbligatorio').fadeOut(10000);
                    $('#address').addClass('is-invalid');
                    errors = true;
                }else if($('#address').val().length < 3){
                    $('#error-address').show('slow').text('Il campo indirizzo deve avere minimo 3 caratteri').fadeOut(10000);
                    $('#address').addClass('is-invalid');
                    errors = true;
                }else if($('#address').val().length > 255){
                    $('#error-address').show('slow').text('Il campo indirizzo può avere massimo 255 caratteri').fadeOut(10000);
                    $('#address').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#address').removeClass('is-invalid')
                }
            //
            // Campo city
                if($('#city').val().length === 0){
                    $('#error-city').show('slow').text('Il campo città è obbligatorio').fadeOut(10000);
                    $('#city').addClass('is-invalid');
                    errors = true;
                }else if($('#city').val().length < 3){
                    $('#error-city').show('slow').text('Il campo città deve avere minimo 3 caratteri').fadeOut(10000);
                    $('#city').addClass('is-invalid');
                    errors = true;
                }else if($('#city').val().length > 255){
                    $('#error-city').show('slow').text('Il campo città può avere massimo 255 caratteri').fadeOut(10000);
                    $('#city').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#city').removeClass('is-invalid')
                }
            //
            // Campo description
                if($('#description').val().length > 2000){
                    $('#error-description').show('slow').text('Il campo descrizione può avere massimo 2000 caratteri').fadeOut(10000);
                    $('#description').addClass('is-invalid');
                    errors = true;
                }else{
                    $('#description').removeClass('is-invalid')
                }
            //
            // Campo price
            if($('#price').val().length === 0){
                $('#error-price').show('slow').text('Il campo prezzo è obbligatorio').fadeOut(10000);
                $('#price').addClass('is-invalid');
                errors = true;
            }
            else if(isNaN($('#price').val())){
                $('#error-price').show('slow').text('Il prezzo deve essere un numero').fadeOut(10000);
                $('#price').addClass('is-invalid');
                errors = true;
            }
            else if($('#price').val() >= 1000000){
                $('#error-price').show('slow').text('Il prezzo deve essere inferiore a 1000000 €').fadeOut(10000);
                $('#price').addClass('is-invalid');
                errors = true;
            }else{
                $('#price').removeClass('is-invalid')
            }
        //
        // checkbox Perks
            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                $('#error-perks').show('slow').text('Almeno un servizio deve essere selezionato').fadeOut(10000);
                errors = true;
            }
        //
            if(errors === true){
                $('#modal-public').modal('hide');
                event.preventDefault();
            }
        })
    }
 })
