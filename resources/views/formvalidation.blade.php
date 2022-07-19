<?php ?>
<!DOCTYPE html>
<html>
    <title>Validation Page</title>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="http://parsleyjs.org/dist/parsley.js"></script>
		<link rel="stylesheet" href="{{asset('/assets/css/parsley.css')}}">
    </head> 
    <body>
        <div class="bs-callout bs-callout-warning hidden">
          <h4>Oh snap!</h4>
          <p>This form seems to be invalid :(</p>
        </div>

        <div class="bs-callout bs-callout-info hidden">
          <h4>Yay!</h4>
          <p>Everything seems to be ok :)</p>
        </div>
        <div class="container">    
            <div class="row">    
                <form id="demo-form" data-parsley-validate="">  
                    <label for="fullname">Full Name * :</label>
                    <input type="text" class="form-control" name="fullname" required="" data-parsley-minlength='2' data-parsley-nospecialschar="" data-parsley-required-message="Full name is required" data-parsley-minlength-message='Please enter more than 2 character'> 

                    <label for="email">Email * :</label>
                    <input type="email" class="form-control" name="email" data-parsley-trigger="change" required="">

                    <label for="contactMethod">Preferred Contact Method *:</label>
                      <p>
                        Email: <input type="radio" name="contactMethod" id="contactMethodEmail" value="Email" required="">
                        Phone: <input type="radio" name="contactMethod" id="contactMethodPhone" value="Phone">
                      </p>

                      <label for="hobbies">Hobbies (Optional, but 2 minimum):</label>
                      <p>
                        Skiing <input type="checkbox" name="hobbies[]" id="hobby1" value="ski" data-parsley-mincheck="2"><br>
                        Running <input type="checkbox" name="hobbies[]" id="hobby2" value="run"><br>
                        Eating <input type="checkbox" name="hobbies[]" id="hobby3" value="eat"><br>
                        Sleeping <input type="checkbox" name="hobbies[]" id="hobbygfhfgh fcgfdgdg4" value="sleep"><br>
                        Reading <input type="checkbox" name="hobbies[]" id="hobby5" value="read"><br>
                        Coding <input type="checkbox" name="hobbies[]" id="hobby6" value="code"><br>
                      </p>

                      <p>
                      <label for="heard">Heard about us via *:</label>
                      <select id="heard" required="">
                        <option value="">Choose..</option>
                        <option value="press">Press</option>
                        <option value="net">Internet</option>
                        <option value="mouth">Word of mouth</option>
                        <option value="other">Other..</option>
                      </select>
                      </p>

                      <p>
                      <label for="message">Message (20 chars min, 100 max) :</label>
                      <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.." data-parsley-validation-threshold="10"></textarea>
                      </p>

                      <br>

                        <label for="question">Please enter a multiple of 3:</label>
                        <input type="text" class="form-control" name="nb" required="" data-parsley-multiple-of="3">

                      <br>
                       <label for="question">Please provide a file smaller than 42Kb:</label>
                        <input type="file" name="f" required="" data-parsley-max-file-size="42" data-parsley-allowed-img="jpeg,png">
                      <br>
                      <label for="password">Password</label>
                      <input type="password" name="password" data-parsley-minlength="6"  id="password" required="" data-parsley-uppercase="1" data-parsley-lowercase="1" data-parsley-number="1" data-parsley-special="1">
                      <br>
                      <br>
                      <label for="password">Password</label>
                      <input type="password" required="" data-parsley-minlength="6" id="confirmPassword" data-parsley-equalto="#password">
                      <br>
                       <input type="submit" class="btn btn-default" value="validate">

                      <p><small>* Please, note that this demo form is not a perfect example of UX-awareness. The aim here is to show a quick overview of parsley-API and Parsley customizable behavior.</small></p>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript">
    window.Parsley.addValidator('multipleOf', {
      validateNumber: function(value, requirement) {
        return value % requirement === 0;
      },
      requirementType: 'integer',
      messages: {
        en: 'This value should be a multiple of %s.',
        fr: "Ce nombre n'est pas un multiple de %s."
      }
    });
    window.Parsley.addValidator('maxFileSize', {
      validateString: function(_value, maxSize, parsleyInstance) {
        console.log('_value=='+_value);
        console.log('maxSize=='+maxSize);
        console.log('parsleyInstance=='+parsleyInstance);
        if (!window.FormData) {
          alert('You are making all developpers in the world cringe. Upgrade your browser!');
          return true;
        }

        var files = parsleyInstance.$element[0].files;
        console.log(files);
        console.log(files[0].size);
        return files.length != 1  || files[0].size <= maxSize * 1024;
      },
      requirementType: 'integer',
      messages: {
        en: 'This file should not be larger than %s Kb',
        fr: 'Ce fichier est plus grand que %s Kb.'
      }
    });
    window.Parsley.addValidator('allowedImg', {
          validateString: function(_value, allowedType, parsleyInstance) {
            console.log('_value=='+_value);
            console.log('maxSize=='+allowedType);
            console.log('parsleyInstance=='+parsleyInstance);
            if (!window.FormData) {
              alert('You are making all developpers in the world cringe. Upgrade your browser!');
              return true;
            }
            var files = parsleyInstance.$element[0].files;
            console.log(files);
            console.log(files[0].size);
            return files.length != 1  || files[0].type == allowedType;
          },
          // requirementType: 'integer',
          messages: {
            en: 'The file not allowed, only allowed %s',
            // fr: 'Ce fichier est plus grand que %s Kb.'
          }
        });

    // Password Validation   
    //has uppercase
    window.Parsley.addValidator('uppercase', {
    requirementType: 'number',
    validateString: function(value, requirement) {
        var uppercases = value.match(/[A-Z]/g) || [];
        return uppercases.length >= requirement;
    },
    messages: {
        en: 'Your password must contain at least (%s) uppercase letter.'
    }
    });

    //has lowercase
    window.Parsley.addValidator('lowercase', {
    requirementType: 'number',
    validateString: function(value, requirement) {
        var lowecases = value.match(/[a-z]/g) || [];
        return lowecases.length >= requirement;
    },
    messages: {
        en: 'Your password must contain at least (%s) lowercase letter.'
    }
    });

    //has number
    window.Parsley.addValidator('number', {
    requirementType: 'number',
    validateString: function(value, requirement) {
        var numbers = value.match(/[0-9]/g) || [];
        return numbers.length >= requirement;
    },
    messages: {
        en: 'Your password must contain at least (%s) number.'
    }
    });

    //has special char
    window.Parsley.addValidator('special', {
    requirementType: 'number',
    validateString: function(value, requirement) {
        var specials = value.match(/[^a-zA-Z0-9]/g) || [];
        return specials.length >= requirement;
    },
    messages: {
        en: 'Your password must contain at least (%s) special characters.'
    }
    });
	//has special char
    window.Parsley.addValidator('nospecialschar', {
    // requirementType: 'number',
    validateString: function(value, requirement) {
        var specials = value.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/g);
		console.log(specials);
		console.log(requirement);
		console.log(value);
		if(specials && specials.length)
        	return specials.length;
    },
    messages: {
        en: 'Full Name should not include special characters.'
    }
    });
</script>
</html>