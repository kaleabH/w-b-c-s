<script>
    function newOptions() {
        var select = document.getElementById("sign_name");
        var hide = document.getElementById("hide").value;
        var flag = document.getElementById("flag").value;
        var count = 0;
        var temp = 0;
        if (select.value == "---------Next--------") {
            var holder = flag == 1 ? parseInt(hide) + 20 : parseInt(hide) + 10;
            select.innerHTML = "";
            {foreach from = $ug_signatories item = i}
                if (count >= (holder - 10) && count < holder) {
                    select.options[select.options.length] = new Option("{$i}");
                    temp = count + 1;
                }
                count++;
            {/foreach}
            select.options[select.options.length] = new Option("---------Back--------");
            if (temp % 10 == 0) {
                select.options[select.options.length] = new Option("---------Next--------");
            }

            document.getElementById("hide").value = holder;
            document.getElementById("flag").value = "0";
        } else if (select.value == "---------Back--------") {


            var holder = parseInt(flag) == 0 ? parseInt(hide) - 20 : parseInt(hide) - 10;
            select.innerHTML = "";

            {foreach from = $ug_signatories item = i}
                if (count >= holder && count < holder + 10) {
                    select.options[select.options.length] = new Option("{$i}");
                }
                count++;
            {/foreach}

            if (parseInt(holder) != 0) {
                select.options[select.options.length] = new Option("---------Back--------");
            }
            select.options[select.options.length] = new Option("---------Next--------");

            document.getElementById("hide").value = holder;
            document.getElementById("flag").value = "1";
        }
    }
</script>

<!-- Breadcrumb-->
{call name=breadcrumb lvl2=1 lvl3=3 activelvl=3}

<div class="row">
    <div class="span3">

        <!-- Header-->
        <h4 class="well center-text well-small">User Accounts</h4>

        <!-- Admin Navigations-->
        {call name=nav_admin index=1}

    </div>
    <div class="span9">

        <!-- Header-->
        <h4 class="well center-text well-small">Add Signatory In-Charge</h4>

        {*
        <div class="navbar">
        <div class="navbar-inner">

        {call name=nav_user_accounts index=4}
        </div>
        </div>
        *}

        <form method='post' class="form-horizontal">
            {literal}
                <legend>Login Information: </legend>

                <div class="control-group">
                    <label class="control-label"><b>Username: </b></label>
                    <div class="controls">
                        <input class="span3" type='text' name='uname' value="" maxlength="15" pattern="[A-Za-z\s\-]+"
                            required title="Letters and numbers only">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><b>Password: </b></label>
                    <div class="controls">
                        <input id="password_entered" class="span3" type='password' name='newpass'
                            pattern="[0-9a-zA-Z]{7,32}" title="Password minimum of 7 characters" required>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><b>Re-type Password: </b></label>
                    <div class="controls">
                        <input id="retyped_password_entered" class="span3" type='password' name='confirmpass'
                            pattern="[0-9a-zA-Z]{7,50}" onblur="checkPasswordEquality()" required>
                    </div>
                </div>

                <legend>Personal Information: </legend>

                <div class="control-group">
                    <label class="control-label"><b>Surname: </b></label>
                    <div class="controls">
                        <input class="span3" type='text' name='surname' value="" pattern="[A-Za-z\s]{2,15}" required
                            title="Letters and spaces only">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><b>First Name: </b></label>
                    <div class="controls">
                        <input class="span3" type='text' name='firstname' value="" pattern="[A-Za-z\s]{2,15}" required
                            title="Letters and spaces only">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><b>Middle Name: </b></label>
                    <div class="controls">
                        <input class="span3" type='text' name='middleName' value="" pattern="[A-Za-z\s]{1,15}" required
                            title="Letters and spaces only">
                    </div>
                </div>
            {/literal}

            <legend>Signatory Designation: </legend>

            <div class="control-group">
                <label class="control-label">
                    <b>Signatory: </b>
                </label>
                <div class="controls">

                    {if !isset($signatories)}
                        {assign var=signatories value=["OCSC", "OSS", "CTLC", "ICLC"]}
                    {/if}

                    <select class="select2 input-large" id="sign_name" name="sign_name" required
                        data-placeholder="Select Signatory">
                        <option></option>
                        {foreach from=$ug_signatories item=signatory key=pk}
                            <option>{$signatory}</option>
                        {/foreach}
                    </select>

                    {*
                    <select class="select2" id="sign_name" name="sign_name" required onchange="">
                    {foreach from=$ug_signatories item=signatory key=pk}
                    <option>{$signatory}</option>
                    {assign var=count value=$count + 1}
                    {/foreach}
                    <option>---------Next--------</option>
                    </select>
                    *}
                    {*<input type=hidden id="hide" value="10">
                    <input type=hidden id="flag" value="0">*}

                    {*
                        <input type="text" id="sign_name" required name="sign_name" autocomplete="off" class="input-large" data-provide="typeahead" data-source='[
                        {foreach from=$ug_signatories key=k item=signatory}

                            {if $ug_signatories|@count - 1 eq $k}
                                "{$signatory}"

                            {else}
                                "{$signatory}",

                            {/if}

                        {/foreach}
                        ]'>
                        *}
                    </div>
                </div>

                <div class="form-actions control-group">
                    <div class="pull-right">
                        <input class="btn btn-primary" type='Submit' value='Register' name='Register'>
                        <button class="btn" onclick="window.history.back();">Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>