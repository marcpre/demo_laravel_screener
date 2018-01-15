$(document).ready(function () {
    'use strict';

    $('.repeater').repeater({
        defaultValues: {
            'textarea-input': 'foo',
            'text-input': 'bar',
            'firstName': 'Sathosi',
            'lastName': 'Nakomoto',
            'twitter': 'www.twitter.com/Sathoshi',
            'eventName': 'Crypto Event',
            'eventLink': 'www.mycryptoevent.com/event'
        },
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        ready: function (setIndexes) {

        }
    });

    window.outerRepeater = $('.outer-repeater').repeater({
        isFirstItemUndeletable: true,
        defaultValues: {
            'text-input': 'outer-default'
        },
        show: function () {
            console.log('outer show');
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            console.log('outer delete');
            $(this).slideUp(deleteElement);
        },
        repeaters: [{
            isFirstItemUndeletable: true,
            selector: '.inner-repeater',
            defaultValues: {
                'inner-text-input': 'inner-default'
            },
            show: function () {
                console.log('inner show');
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                console.log('inner delete');
                $(this).slideUp(deleteElement);
            }
        }]
    });
});
