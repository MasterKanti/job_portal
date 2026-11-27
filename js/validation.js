const validation = new JustValidate("#signup");

validation
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        }
    ])
    .addField("#first_name", [
        {
            rule: "required"
        }
    ])