import {fadeIn, fadeOut, isHidden, onClickOutside} from './functions.js';


var CSRF = document.querySelector('input[name=_token]').value;
let searchForm = document.querySelector('.search__form');
let searchInput = document.querySelector('.search__input');
let searchResults = document.querySelector('.search-results__container');
let search_from_container = document.querySelector('.search-form-container');
let search_form_active_btn = document.querySelector('.search-form-active-btn');
let search_from_close_btn = document.querySelector('.search-from-close-btn');
var searchButton = document.querySelector('.search__button');

if (typeof(searchForm) != 'undefined' && searchForm != null &&
    typeof(searchInput) != 'undefined' && searchInput != null &&
    typeof(searchResults) != 'undefined' && searchResults != null) {

    var search = function(query) {

        const request = new XMLHttpRequest();
        const url = "/ajax/search";
        // const params = JSON.stringify({
        //     query:  query
        // });
        const params = 'query=' + query;

        request.open("POST", url, true);

        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.setRequestHeader("X-CSRF-TOKEN", CSRF);

        request.addEventListener("readystatechange", () => {
            if(request.readyState === 4 && request.status === 200) {
                // let data = JSON.parse(request.responseText);
                searchResults.innerHTML = request.responseText;
            }
        });

        request.send(params);
    };

    var searchEvent = function(e) {
        var query = searchInput.value;

        if (searchInput !== document.activeElement) {
            searchInput.focus();
        }

        try {
            search(query);
        } catch (e) {
            console.log(e);
            return true;
        } finally {
            e.preventDefault();
            e.stopPropagation();
        }
    };


    if (typeof(searchButton) != 'undefined' && search_from_container != null) {

        searchButton.addEventListener('mousedown', function(e) {
            e.preventDefault();
        });

        searchButton.addEventListener('click', searchEvent);

    }

    // searchForm.submit(searchEvent);

    if (searchInput.value !== '') {
        searchEvent();
    }
}



if (typeof(search_from_container) != 'undefined' && search_from_container != null) {

    function close_search_form() {
        fadeOut(search_from_container);
    }

    search_form_active_btn.addEventListener('click', function () {

        let search_input = search_from_container.querySelector("[name='query']");

        if (isHidden(search_from_container)) {
            fadeIn(search_from_container);
        }

        search_input.focus();
    });

    search_from_close_btn.addEventListener('click', function () {
        close_search_form();
    });

    onClickOutside(search_from_container, () => close_search_form());

}
