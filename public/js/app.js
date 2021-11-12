$(document).ready(function () {
    init()
});

function init() {
    initDataTable();
    initFormModal();
    initCategorySelect();
    initExport();
    initMeasurementConverter();
    initTemperatureConverter();
}

function initDataTable() {
    $('.DataTable').DataTable({
        pageLength: 25,
    });
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
        };

        const config = {
            'nouns': [fields.baseForm, fields.baseFormIpa, fields.countability, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'adjectives': [fields.baseForm, fields.baseFormIpa, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'toponyms': [fields.baseForm, fields.baseFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'demonyms': [fields.baseForm, fields.baseFormIpa, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
            'verbs': [fields.infinitive, fields.infinitiveIpa, fields.transitivity, fields.conjugation, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
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
            'Codian (obsolete)' : [fields.baseForm, fields.baseFormIpa, fields.partOfSpeech, fields.pluralForm, fields.pluralFormIpa, fields.equivalentEnglish, fields.definitionEnglish, fields.equivalentOtherLanguages, fields.additionalInformation, fields.dialect, fields.etymology],
        };

        if (config[category]) {
            $.each(config[category], function (number, element) {
                if (hideAllFields()) {
                    $(element).css('order', number);
                    setTimeout(function () { $(element).show(); }, 100)
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
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl, {html: true,})
            });

            $(document).on('click', '.ipa-button', function () {
                const value = $(this).data('value');
                let elementId = $('#'+$(this).parent().data('element'));
                $(elementId).val($(elementId).val() + value);
            });
        }

        $(document).on('click', '.ipa-popup',function () {
            let body = $('.popover-body');
            $(body).html(popoverContent);
            $(body).data('element', $(this).attr('id'));
            $(body).attr('data-element', $(this).attr('id'));

        });

        const popoverContent = "" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ə'>ə</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ð'>ð</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ɛ'>ɛ</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ɣ'>ɣ</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ʒ'>ʒ</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ɔ'>ɔ</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ɾ'>ɾ</button>\n" +
            "<button class='btn btn-outline-secondary text-white ipa-button' type='button' data-value='ʃ'>ʃ</button>\n";
    }
}

function initCategorySelect() {
    if (sessionStorage.getItem('category')) {
        const category = sessionStorage.getItem('category');
        updateTable(category);
        $('#category-select').val(category);
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

    $('.export-form').on('change','input[name=all-categories]:checked',function(){
        var value = $(this).val();
        if (value === 'false') {
            $('#export-category-select').prop('disabled', false);
        } else {
            $('#export-category-select').prop('disabled', true);
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
