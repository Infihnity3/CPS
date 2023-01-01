const validation = new JustValidate('#register');

validation
    .addField("#name", [
        {
            rule: 'required'
        }
    ])
    .addField("#email", [
        {
            rule: 'required'
        },
        {
            rule: 'email'
        }
    ])
    .addField("#password", [
        {
            rule: 'required'
        },
        {
            rule: 'password',
        }
    ])
    .addField("#password2", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: 'Passwords do not match'
        }
    ])
    onSuccess((event) = {
        document.getElementById("register").submit();
    });