# form-partial
Generate form with php arrays

## submodules
This form-partial use for the validation: 
https://jquery.com/ and 
https://jqueryvalidation.org

So init submodules by: git submodule init && git submodule update

# HOW TO START

## jQuery
Generate jQuery by: [code]cd assets/js/libs/jQuery && npm run build [/code].

In one line:
[code]git submodule init && git submodule update && cd assets/js/libs/jQuery && npm run build && cd .. && cd jQuery.validation/ && npm install && grunt && cd ../../../../ && grunt all[/code]