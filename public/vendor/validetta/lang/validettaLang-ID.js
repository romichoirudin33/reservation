(function($){
    $.fn.validettaLanguage = {};
    $.validettaLanguage = {
        init : function(){
            $.validettaLanguage.messages = {
                required	: 'Inputan harus di isi.',
                email		: 'Email tidak valid.',
                number		: 'Inputan harus berupa angka.',
                maxLength	: 'Inputan maksimal {count} karakter.',
                minLength	: 'Inputan minimal {count} karakter.',
                maxChecked	: 'Inputan maksimal {count} yang harus di pilih.',
                minChecked	: 'Inputan minimal harus {count} yg di pilih.',
                maxSelected	: 'Inputan maksimal {count} yang harus di pilih.',
                minSelected	: 'Inputan minimal harus {count} yg di pilih.',
                notEqual	: 'Inputan tidak sama.',
                different   : 'Inputan tidak boleh sama',
                creditCard	: 'Kredit card tidak valid.'
            };
        }
    };
    $.validettaLanguage.init();
})(jQuery);