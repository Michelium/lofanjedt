$(document).ready(function () {
    init()
});

function init() {
    initDataTable();
    initFormModal();
    initShortcutKeys();
    initCategorySelect();
    initExport();
    initSelect2();
    initMeasurementConverter();
    initTemperatureConverter();
}

function initDataTable() {
    if ( ! $.fn.DataTable.isDataTable( '.DataTable' ) ) {
        $('.DataTable').DataTable({
            pageLength: 25,
        });
    }
    
}

function initFormModal() {
    $(document).on('click', '.form-modal-button', function () {
        const id = $(this).data('id');

        $.ajax({
            url: '/entry/get-form',
            data: {
                id: id,
            },
        })
            .done(function (data) {
                let body = $('.modal-body');
                $(body).empty();
                $(body).append(data);

                let form = $(body).find('form');
                $(form).attr('action', '/entry/form/' + id)

                initSelect2()
                initDynamicFormFields();
            });
    });
}

function initDynamicFormFields() {
    const categoryElement = $('#entry_category');

    $(categoryElement).on('change', updateFields);
    updateFields();

    function updateFields() {
        let category = $(categoryElement).val();

        const fields = {
            baseForm: $('#entry_baseForm').parent().parent(),
            baseFormIpa: $('#entry_baseFormIpa').parent().parent(),
            countability: $('#entry_countability').parent().parent(),
            pluralForm: $('#entry_pluralForm').parent().parent(),
            pluralFormIpa: $('#entry_pluralFormIpa').parent().parent(),
            equivalentEnglish: $('#entry_equivalentEnglish').parent().parent(),
            definitionEnglish: $('#entry_definitionEnglish').parent().parent(),
            equivalentOtherLanguages: $('#entry_equivalentOtherLanguages').parent().parent(),
            additionalInformation: $('#entry_additionalInformation').parent().parent(),
            dialect: $('#entry_dialect').parent().parent(),
            etymology: $('#entry_etymology').parent().parent(),
            infinitive: $('#entry_infinitive').parent().parent(),
            infinitiveIpa: $('#entry_infinitiveIpa').parent().parent(),
            transitivity: $('#entry_transitivity').parent().parent(),
            conjugation: $('#entry_conjugation').parent().parent(),
            definiteness: $('#entry_definiteness').parent().parent(),
            meaning: $('#entry_meaning').parent().parent(),
            gender: $('#entry_gender').parent().parent(),
            literalMeaningEnglish: $('#entry_literalMeaningEnglish').parent().parent(),
            pronounsType: $('#entry_pronounsType').parent().parent(),
            conjunctionsType: $('#entry_conjunctionsType').parent().parent(),
            adpositionsType: $('#entry_adpositionsType').parent().parent(),
            numeralsType: $('#entry_numeralsType').parent().parent(),
            affixesType: $('#entry_affixesType').parent().parent(),
            partOfSpeech: $('#entry_partOfSpeech').parent().parent(),
            verbalRoots: $('#entry_verbalRoots').parent().parent(),
        };

        const config = {
            'nouns': [fields.baseForm, fields.baseFormIpa, fields.countability, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'adjectives': [fields.baseForm, fields.baseFormIpa, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'toponyms': [fields.baseForm, fields.baseFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'demonyms': [fields.baseForm, fields.baseFormIpa, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'verbs': [fields.infinitive, fields.infinitiveIpa, fields.transitivity, fields.conjugation, fields.verbalRoots, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'articles': [fields.baseForm, fields.baseFormIpa, fields.definiteness, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'pronouns': [fields.baseForm, fields.baseFormIpa, fields.pronounsType, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'conjunctions': [fields.baseForm, fields.baseFormIpa, fields.conjunctionsType, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'adverbs': [fields.baseForm, fields.baseFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'adpositions': [fields.baseForm, fields.baseFormIpa, fields.adpositionsType, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'numerals': [fields.baseForm, fields.baseFormIpa, fields.numeralsType, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'interjections': [fields.baseForm, fields.baseFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'affixes': [fields.baseForm, fields.baseFormIpa, fields.affixesType, fields.pluralForm, fields.pluralFormIpa, fields.meaning, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'phrases': [fields.baseForm, fields.baseFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'names': [fields.baseForm, fields.baseFormIpa, fields.gender, fields.literalMeaningEnglish, fields.additionalInformation, fields.dialect, fields.etymology],
            'Daitic (obsolete)': [fields.baseForm, fields.baseFormIpa, fields.partOfSpeech, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'Codian (obsolete)': [fields.baseForm, fields.baseFormIpa, fields.partOfSpeech, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
        };

        if (config[category]) {
            $.each(config[category], function (number, element) {
                if (hideAllFields()) {
                    $(element).css('order', number);
                    setTimeout(function () {
                        $(element).show();
                    }, 100)
                }
            })
            setTimeout(popovers, 100);
        }

        function hideAllFields() {
            $.each(fields, function (field, element) {
                $(element).hide();
                $(element).css('order', null);
            })
            return true;
        }

        function popovers() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl, {
                    html: true,
                    trigger: 'focus',
                })
            });

            $('.ipa-button').off();
            $(document).on('click', '.ipa-button', function () {
                const value = $(this).data('value');
                let elementId = $('#' + $(this).closest('.popover-body').data('element'));
                $(elementId).val($(elementId).val() + value);
                $(elementId).focus();
                $(elementId).trigger('click');
            });
        }

        $(document).on('click', '.ipa-popup', function () {
            let body = $('.popover-body');
            let content = $('.popover-buttons').html();
            $(body).html(content);
            $(body).data('element', $(this).attr('id'));
            $(body).attr('data-element', $(this).attr('id'));

        });
    }
}

function initShortcutKeys() {
    let keysPressed = {};

    document.addEventListener('keydown', (event) => {
        keysPressed[event.key] = true;
    });
    document.addEventListener('keyup', (event) => {
        delete keysPressed[event.key]
    });
    document.addEventListener('keydown', (event) => {
        keysPressed[event.key] = true;
        let input = $('input:focus');
        let character = null;

        if (keysPressed['Control'] && keysPressed['Shift']) {
            switch (event.key) {
                case '!': character = '«'; break;
                case '@': character = '»'; break;
                case '#': character = 'ˌ'; break;
                case '$': character = 'ˈ'; break;
                case '%': character = 'ð'; break;
                case 'Dead': character = 'ɛ'; break;
                case '&': character = 'ɣ'; break;
                case '*': character = 'ɔ'; break;
                case '(': character = 'ɾ'; break;
                case ')': character = 'ʃ'; break;
            }
        }
        
        if (character !== null) {
            $(input).val( $(input).val() + character)
        }
    });

    document.addEventListener('keyup', (event) => {
        delete keysPressed[event.key];
    });
}

function initCategorySelect() {
    if (sessionStorage.getItem('category')) {
        const category = sessionStorage.getItem('category');
        updateTable(category);
        $('#category-select').val(category);
    } else {
        sessionStorage.setItem('category', 'nouns');
        updateTable('nouns');
    }

    $(document).on('change', '#category-select', function () {
        const category = $(this).val();
        sessionStorage.setItem('category', category);
        updateTable(category);
    });

    function updateTable(category) {
        $.ajax({
            url: '/lofanje/get-table',
            data: {
                category: category,
            }
        }).done(function (data) {
            let main = $('main');
            $(main).empty();
            $(main).append(data);
            initDataTable();
        })
    }
}

function initExport() {
    $('#export-category-select').select2({
        dropdownParent: $('#exportModal'),
        tags: true,
    });

    $('.export-form').on('change', 'input[name=all-categories]:checked', function () {
        var value = $(this).val();
        if (value === 'false') {
            $('#export-category-select').prop('disabled', false);
        } else {
            $('#export-category-select').prop('disabled', true);
        }
    });
}

function initSelect2() {
    $('#formModal').find('.select-2').each(function () {
        const optionsObject = document.getElementById($(this).attr('id')).options;
        let options = [];
        for (let i = 0; i < optionsObject.length; i++) {
            options.push(optionsObject[i].value);
        }
        if (!options.includes($(this).val())) {
            let newOption = new Option($(this).val(), $(this).val(), true, true);
            $(this).append(newOption).trigger('change');
        }

        if ($(this).hasClass('select2-custom')) {
            $(this).select2({
                tags: true, createTag: function (params) {
                    return {id: params.term, text: params.term, newOption: true}
                }, templateResult: function (data) {
                    var result = data.text;
                    if (data.newOption) {
                        result = result + ' (custom)';
                    }
                    return result;
                },
                dropdownParent: $('#formModal > .modal-dialog > .modal-content'),
                theme: "bootstrap-5",
            });
        } else {
            $('.select2').select2({
                dropdownParent: $('#formModal > .modal-dialog > .modal-content'),
                theme: "bootstrap-5",
            });
        }
    });
}

function initMeasurementConverter() {
    if (document.getElementById('meter')) {
        document.getElementById('meter').addEventListener('keydown', meterToJodjorami);
    }
    if (document.getElementById('jodjorami')) {
        document.getElementById('jodjorami').addEventListener('keydown', jodjoramiToMeter);
    }

    function meterToJodjorami() {
        let meter = document.getElementById('meter').value;

        let jodjoramiValue = meter * 1.17554375;

        document.getElementById('jodjorami').value = jodjoramiValue;
        document.getElementById('madirami').innerHTML = "(" + jodjoramiValue * 3 + " madirami)";
    }

    function jodjoramiToMeter() {
        let jodjorami = document.getElementById('jodjorami').value;

        document.getElementById('meter').value = jodjorami * 0.85067016859;
    }
}

function initTemperatureConverter() {
    if (document.getElementById('fahrenheit')) {
        document.getElementById('fahrenheit').addEventListener('keydown', fahrenheitToGambino);
    }
    if (document.getElementById('gambino')) {
        document.getElementById('gambino').addEventListener('keydown', gambinoToFahrenheit);
    }

    function fahrenheitToGambino() {
        let fahrenheit = document.getElementById('fahrenheit').value;

        document.getElementById('gambino').value = Math.round((fahrenheit - 32) / (178 / 169));
    }

    function gambinoToFahrenheit() {
        let gambino = document.getElementById('gambino').value;

        document.getElementById('fahrenheit').value = Math.round(gambino * (178 / 169) + 32);
    }
}
