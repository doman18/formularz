/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$().ready(function() {

        $("#formularzkontaktowy").validate({
                rules: {
                        imie: {
                                required: true,
                                minlength: 3,
                                maxlength: 50
                        },
                        nazwisko: {
                                required: true,
                                minlength: 3,
                                maxlength: 50
                        },
                        email: {
                                required: true,
                                email: true
                        },
                        temat: {
                                required: true,
                                minlength: 4,
                                maxlength: 50
                        },
                        wiadomosc: "required"
                },
                messages: {
                        imie: {
                                required: "Podaj swoje imię",
                                minlength: "Imię musi mieć przynajmniej 3 znaki",
                                maxlength: "Imię może mieć maksimum 50 znaków",
                        },
                        nazwisko: {
                                required: "Podaj swoje nazwisko",
                                minlength: "Nazwisko musi mieć przynajmniej 3 znaki",
                                maxlength: "Nazwisko może mieć maksimum 50 znaków",
                        },
                        email: {
                        required: "Podaj swój adres email",
                        email: "Podany adres nie jest prawidłowy"
                        },
                        temat: {
                                required: "Podaj temat wiadomości",
                                minlength: "Temat musi mieć przynajmniej 4 znaki",
                                maxlength: "Temat może mieć maksimum 50 znaków",
                        },
                        wiadomosc: "Wiadomość nie może być pusta"
                }
        });



});
