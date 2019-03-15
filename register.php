<?php include_once 'header.php';
$fullName = $email = $telnr = $password = $address = $address2 = $city = $zip = $country = $agreement = "";
$fullNameError = $emailError = $telnrError = $passwordError = $addressError = $address2Error = $cityError = $zipError = $countryError = $agreementError = "";
$error = false;
$succedMSG = $errorMSG = "";
$sql ="";
if (isset($_POST['submit'])) {

    /**
     * Securing the input
     */
    $fullName = test_input($_POST['fullname']);
    $email = test_input($_POST['email']);
    $telnr = test_input($_POST['telnr']);
    $password = test_input($_POST['password']);
    $address = test_input($_POST['address']);
    $address2 = test_input($_POST['address2']);
    $city = test_input($_POST['city']);
    $zip = test_input($_POST['zip']);
    $country = test_input($_POST['country']);
    $agreement = test_input($_POST['agreement']);

    /**
     * Check the field name:
     */
    if (isset($fullName)) {
        if (empty($fullName)) {
            $error = true;
            $fullNameError = "The full name field cannot be left empty";
        }
        if (strlen($fullName) < 3) {
            $error = true;
            $fullNameError = "The full name field cannot be less than 3 characters";
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $fullName)) {
            $error = true;
            $fullNameError = "Only letters are allowed.";
        }

    }
    /**
     * Check the email address field:
     */
    $emailSQL = "SELECT email FROM user WHERE email = '$email'";
    $emailRESULT = $conn->query($emailSQL);
    if ($emailRESULT->num_rows > 0) {
        $error = true;
        $emailError = "the email is already in used, please choose another one.";
    }
    if (!empty($email)) {

        if (empty($email)) {
            $error = true;
            $emailError = "The email field must be filled.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $emailError = "The email address you've entered is not legal.";
        }
    } else {
        $error = true;
        $emailError = "The email field cannot be left empty";
    }
    /**
     * Check the telnr field:
     */
    if (!empty($telnr)) {
        if (strlen($telnr) < 6) {
            $error = true;
            $telnrError = "The telephone number is not valid.";
        }
    } else {
        $error = true;
        $telnrError = "The telepgone number field cannot be left empty";
    }
    /**
     * Check the password field:
     */
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $error = true;
            $passwordError = "The password cannot be less than 8 characters";
        }

    }
    /**
     * check the address field:
     */
    if (!empty($address)) {
        if (strlen($address) < 5) {
            $error = true;
            $addressError = "The address field canno be less than 5 characters";
        }
    } else {
        $error = true;
        $addressError = "The address field cannot be left empty";
    }
    /**
     * Check the city field:
     */
    if (empty($city)) {
        $error = true;
        $cityError = "The city name cannot be lefr empty.";
    }
    /**
     * Check the zip code:
     */
    if (empty($zip)) {
        $error = true;
        $zipError = "The postal code is required";
    }
    /**
     * Check the agreement
     */
    if (empty($agreement)) {
        $error = true;
        $agreementError = "The agreement must be checked";
    }

    /**
     * check all errors are corrected now and submit them / insert them into the database
     * Table: user
     */
    if ($error === false) {
        $password = md5($password);
        $sql = "INSERT INTO user(fullname, email, password, telnr, address, address2, zip, city, country)" . "  VALUES
('$fullName' , '$email' , '$password' , '$telnr' , '$address' , '$address2' , '$zip' , '$city' , '$country')";
        if ($conn->query($sql) === true) {
            $succedMSG = "New record created successfully";
            $last_id = $conn->insert_id; // get the current user's id in order to use it in booking page
            $_SESSION['currentID'] = $last_id; // save the data in session to pass them through our script
            header("Location: index.php");
        } else {
            $errorMSGr = "Error: " . $sql . "<br>" . mysqli_error($conn);
            if($conn->connect_errno) {

                print_r($conn->connect_error);

            }
        }

    }
}

?>

<form method="post" action="register.php">
    <div class="form-group">
        <label for="user-fullname">Full Name</label> <label class="text text-danger"
                                                            for="user-fullname"><?php if (isset($fullNameError)) {
                echo $fullNameError;
            } ?></label>
        <input type="text" class="form-control" name="fullname" id="user-fullname" value="<?php echo $fullName ?>" placeholder="John Smith">
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="user-email">Email</label> <label class="text text-danger"
                                                         for="user-email"><?php if (isset($emailError)) {
                    echo $emailError;
                } ?></label>
            <input type="email" value="<?php echo $email ?>" class="form-control" name="email" id="user-email" placeholder="E-mail Address">
        </div>
        <div class="form-group col-md-4">
            <label for="user-telnr">Telephone nr</label> <label class="text text-danger"
                                                                for="user-telnre"><?php if (isset($telnrError)) {
                    echo $telnrError;
                } ?></label>
            <input type="tel" value="<?php echo $telnr ?>" class="form-control" name="telnr" id="user-telnr" placeholder="+46 73 247 5275">
        </div>
        <div class="form-group col-md-4">
            <label for="user-password">Password (at least 8 characters)</label>
            <label for="user-password" class="text text-danger"><?php if (isset($passwordError)) {
                    echo $passwordError;
                } ?></label>
            <input type="password"  value="<?php echo $password ?>" class="form-control" name="password" id="user-password" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <label for="address">Address</label> <label for="address"
                                                    class="text text-danger"><?php if (isset($addressError)) {
                echo $addressError;
            } ?></label>
        <input type="text" value="<?php echo $address ?>" class="form-control" id="address" name="address" placeholder="1234 Main St">
    </div>
    <div class="form-group">
        <label for="address2">Address 2</label> <label for="address2"
                                                       class="text text-danger"><?php if (isset($address2Error)) {
                echo $address2Error;
            } ?></label>
        <input type="text" value="<?php echo $address2 ?>" class="form-control" id="address2" name="address2"
               placeholder="Apartment, studio, floor or c/o">
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="city">City</label> <label class="text text-danger" for="city"><?php if (isset($cityError)) {
                    echo $cityError;
                } ?></label>
            <input type="text" class="form-control" value="<?php echo $city ?>" id="city" name="city">
        </div>
        <div class="form-group col-md-2">
            <label for="zip">Zip</label> <label for="zip" class="text text-danger"><?php if (isset($zipError)) {
                    echo $zipError;
                } ?></label>
            <input type="text" value="<?php ?>" class="form-control" name="zip" id="zip">
        </div>
        <div class="form-group col-md-4">
            <label for="country">Country</label> <label for="country"
                                                        class="text text-danger"><?php if (isset($countryError)) {
                    echo $countryError;
                } ?></label>
            <select id="country" name="country" class="form-control" >
                <option selected>Choose...</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of
                </option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich
                    Islands
                </option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" name="agreement" type="checkbox" id="agreement">
            <label class="form-check-label" for="agreement">
                I agree the term of service and privacy policy
            </label>
            <label class="text text-danger" for="agreement"><?php
                echo $agreementError;
                ?></label>
        </div>
    </div>
    <?php if (isset($succedMSG)) { ?>
        <label class="text text-success">    <?php echo $succedMSG ?> </label>
        <?php
    } else if (isset($errorMSG)) {
        ?>
        <label class="text text-danger"><?php echo $errorMSG ?></label>
        <?php
    } ?>

    <input type="submit" class="btn btn-primary" name="submit" value="Sign up">
</form>
<?php echo $sql ?>
<?php include_once 'footer.php'; ?>
