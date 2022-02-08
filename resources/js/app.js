require('./bootstrap');
require('select2');

const ujs = require('@rails/ujs');
const $ = require('jquery')

ujs.start();
$(document).ready(function() {
    $('.select2-multiple').select2({ placeholder: '', allowClear: true });
});