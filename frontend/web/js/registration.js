$(function() {
    // This simple js script utilizes form's UI interaction with user
    // It hides/shows different fields of form (which are necessary or not)
    // In accordance with required fields

    var isLegalBody = false; 
    var privateEnterpInputGroup = $(".field-registrationform-private_enterpreneur");
    var companyNameInputGroup = $(".field-registrationform-company_name");
    var taxNumberInputGroup = $(".field-registrationform-tax_number");
    
    $( document ).ready(function() {
        updateInputsState();
    });
    
    $(document).off('change', '#registrationform-legal_body').on('change', '#registrationform-legal_body', function() {
        updateInputsState();
    });

    $(document).off('change', '#registrationform-private_enterpreneur').on('change', '#registrationform-private_enterpreneur', function() {
        updateInputsState();
    });

    function updateInputsState()
    {
        isLegalBody = ($('#registrationform-legal_body').val() == 1);
        isEnterpreneur = ($('#registrationform-private_enterpreneur').val() == 1);

        if (isLegalBody)
        {
            privateEnterpInputGroup.hide();
            companyNameInputGroup.show();
            taxNumberInputGroup.show();
        }
        else
        {
            privateEnterpInputGroup.show();
            companyNameInputGroup.hide();
            if (isEnterpreneur)
                taxNumberInputGroup.show();
            else
                taxNumberInputGroup.hide();
        }
    }
});