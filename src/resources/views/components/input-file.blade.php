<style>
    .file-loader-wrapper {
        display: flex;
        width: fit-content;
        flex-direction: column;
        row-gap: 10px;
    }

    .file-loader__button {
        height: 0;
        width: 0;
        padding: 0;
        border: 0 !important;
    }

    .Documents-btn {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: fit-content;
        height: 45px;
        border: none;
        padding: 0px 15px;
        border-radius: 5px;
        background-color: rgb(49, 49, 83);
        gap: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .folderContainer {
        width: 40px;
        height: fit-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        position: relative;
    }

    .fileBack {
        z-index: 1;
        width: 80%;
        height: auto;
    }

    .filePage {
        width: 50%;
        height: auto;
        position: absolute;
        z-index: 2;
        transition: all 0.3s ease-out;
    }

    .fileFront {
        width: 85%;
        height: auto;
        position: absolute;
        z-index: 3;
        opacity: 0.95;
        transform-origin: bottom;
        transition: all 0.3s ease-out;
    }

    .text {
        color: white;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .Documents-btn:hover .filePage {
        transform: translateY(-5px);
    }

    .Documents-btn:hover {
        background-color: rgb(58, 58, 94);
    }

    .Documents-btn:active {
        transform: scale(0.95);
    }

    .Documents-btn:hover .fileFront {
        transform: rotateX(30deg);
    }

    button.tooltip,
    button.file__edit {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border: 0px solid transparent;
        background-color: rgba(100, 77, 237, 0.08);
        border-radius: 1.25em;
        transition: all 0.2s linear;
    }

    button.file__edit {
        svg {
            width: 25px;
            height: 25px
        }
    }

    button.tooltip:hover,
    button.file__edit:hover {
        box-shadow: 3.4px 2.5px 4.9px rgba(0, 0, 0, 0.025),
            8.6px 6.3px 12.4px rgba(0, 0, 0, 0.035),
            17.5px 12.8px 25.3px rgba(0, 0, 0, 0.045),
            36.1px 26.3px 52.2px rgba(0, 0, 0, 0.055),
            99px 72px 143px rgba(0, 0, 0, 0.08);
    }

    .files {
        display: flex;
        flex-direction: column;
        row-gap: 15px;

        .file {
            display: flex;
            align-items: center;
            column-gap: 20px;

            .file__name {
                max-width: 80%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: clip;
            }
        }
    }

    .file__action {
        display: flex;
        position: relative;
        column-gap: 5px;

        .comment-popup {
            display: none;
            position: absolute;
            height: 100px;
            width: 250px;
            top: 120%;
            left: 0;
            z-index: 100;

            textarea {
                width: 100%;
                height: 100%;
                font-size: 1.2em;
                padding-right: 40px;
            }
        }
    }
</style>

<div class="file-loader-wrapper">
    <span>{!! $attributes->get('title') !!}</span>
    <label class="file-loader" for="file-uploader__{{ $attributes->get('name') }}">
        <input id="file-uploader__{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}"
            data-document="{{ $attributes->get('document') }}" data-page="{{ $attributes->get('page') }}"
            class="file-loader__button" type="file" {{ $attributes->get('isMultiple') == true ? 'multiple' : '' }}>
        <div class="Documents-btn">
            <span class="folderContainer">
                <svg class="fileBack" width="146" height="113" viewBox="0 0 146 113" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 4C0 1.79086 1.79086 0 4 0H50.3802C51.8285 0 53.2056 0.627965 54.1553 1.72142L64.3303 13.4371C65.2799 14.5306 66.657 15.1585 68.1053 15.1585H141.509C143.718 15.1585 145.509 16.9494 145.509 19.1585V109C145.509 111.209 143.718 113 141.509 113H3.99999C1.79085 113 0 111.209 0 109V4Z"
                        fill="url(#paint0_linear_117_4)"></path>
                    <defs>
                        <linearGradient id="paint0_linear_117_4" x1="0" y1="0" x2="72.93"
                            y2="95.4804" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#8F88C2"></stop>
                            <stop offset="1" stop-color="#5C52A2"></stop>
                        </linearGradient>
                    </defs>
                </svg>
                <svg class="filePage" width="88" height="99" viewBox="0 0 88 99" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="88" height="99" fill="url(#paint0_linear_117_6)"></rect>
                    <defs>
                        <linearGradient id="paint0_linear_117_6" x1="0" y1="0" x2="81"
                            y2="160.5" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white"></stop>
                            <stop offset="1" stop-color="#686868"></stop>
                        </linearGradient>
                    </defs>
                </svg>

                <svg class="fileFront" width="160" height="79" viewBox="0 0 160 79" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.29306 12.2478C0.133905 9.38186 2.41499 6.97059 5.28537 6.97059H30.419H58.1902C59.5751 6.97059 60.9288 6.55982 62.0802 5.79025L68.977 1.18034C70.1283 0.410771 71.482 0 72.8669 0H77H155.462C157.87 0 159.733 2.1129 159.43 4.50232L150.443 75.5023C150.19 77.5013 148.489 79 146.474 79H7.78403C5.66106 79 3.9079 77.3415 3.79019 75.2218L0.29306 12.2478Z"
                        fill="url(#paint0_linear_117_5)"></path>
                    <defs>
                        <linearGradient id="paint0_linear_117_5" x1="38.7619" y1="8.71323" x2="66.9106"
                            y2="82.8317" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#C3BBFF"></stop>
                            <stop offset="1" stop-color="#51469A"></stop>
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <p class="text">Загрузить файлы</p>
        </div>
    </label>

    <div class="file-loader__files files">
        @if (empty($attributes->get('files')) || $attributes->get('files')->count() == 0)
            <div class="file" style="display: none">
                <a class="file__name"></a>
                <div class="file__action">
                    <button class="tooltip">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="25"
                            width="25">
                            <path fill="#6361D9"
                                d="M8.78842 5.03866C8.86656 4.96052 8.97254 4.91663 9.08305 4.91663H11.4164C11.5269 4.91663 11.6329 4.96052 11.711 5.03866C11.7892 5.11681 11.833 5.22279 11.833 5.33329V5.74939H8.66638V5.33329C8.66638 5.22279 8.71028 5.11681 8.78842 5.03866ZM7.16638 5.74939V5.33329C7.16638 4.82496 7.36832 4.33745 7.72776 3.978C8.08721 3.61856 8.57472 3.41663 9.08305 3.41663H11.4164C11.9247 3.41663 12.4122 3.61856 12.7717 3.978C13.1311 4.33745 13.333 4.82496 13.333 5.33329V5.74939H15.5C15.9142 5.74939 16.25 6.08518 16.25 6.49939C16.25 6.9136 15.9142 7.24939 15.5 7.24939H15.0105L14.2492 14.7095C14.2382 15.2023 14.0377 15.6726 13.6883 16.0219C13.3289 16.3814 12.8414 16.5833 12.333 16.5833H8.16638C7.65805 16.5833 7.17054 16.3814 6.81109 16.0219C6.46176 15.6726 6.2612 15.2023 6.25019 14.7095L5.48896 7.24939H5C4.58579 7.24939 4.25 6.9136 4.25 6.49939C4.25 6.08518 4.58579 5.74939 5 5.74939H6.16667H7.16638ZM7.91638 7.24996H12.583H13.5026L12.7536 14.5905C12.751 14.6158 12.7497 14.6412 12.7497 14.6666C12.7497 14.7771 12.7058 14.8831 12.6277 14.9613C12.5495 15.0394 12.4436 15.0833 12.333 15.0833H8.16638C8.05588 15.0833 7.94989 15.0394 7.87175 14.9613C7.79361 14.8831 7.74972 14.7771 7.74972 14.6666C7.74972 14.6412 7.74842 14.6158 7.74584 14.5905L6.99681 7.24996H7.91638Z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @foreach ($attributes->get('files') as $file)
            @php
                $field = $attributes->get('field');
            @endphp

            <div class="file">
                <a href="{{ $attributes->get('path') }}" class="file__name">{{ $file->$field }}</a>
                <div class="file__action">
                    <button data-id="{{ $file->id }}" class="file__edit">
                        <svg width="64px" height="64px" viewBox="0 -0.5 25 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M13.2942 7.95881C13.5533 7.63559 13.5013 7.16358 13.178 6.90453C12.8548 6.64549 12.3828 6.6975 12.1238 7.02072L13.2942 7.95881ZM6.811 14.8488L7.37903 15.3385C7.38489 15.3317 7.39062 15.3248 7.39623 15.3178L6.811 14.8488ZM6.64 15.2668L5.89146 15.2179L5.8908 15.2321L6.64 15.2668ZM6.5 18.2898L5.7508 18.2551C5.74908 18.2923 5.75013 18.3296 5.75396 18.3667L6.5 18.2898ZM7.287 18.9768L7.31152 19.7264C7.36154 19.7247 7.41126 19.7181 7.45996 19.7065L7.287 18.9768ZM10.287 18.2658L10.46 18.9956L10.4716 18.9927L10.287 18.2658ZM10.672 18.0218L11.2506 18.4991L11.2571 18.491L10.672 18.0218ZM17.2971 10.959C17.5562 10.6358 17.5043 10.1638 17.1812 9.90466C16.8581 9.64552 16.386 9.69742 16.1269 10.0206L17.2971 10.959ZM12.1269 7.02052C11.8678 7.34365 11.9196 7.81568 12.2428 8.07484C12.5659 8.33399 13.0379 8.28213 13.2971 7.95901L12.1269 7.02052ZM14.3 5.50976L14.8851 5.97901C14.8949 5.96672 14.9044 5.95412 14.9135 5.94123L14.3 5.50976ZM15.929 5.18976L16.4088 4.61332C16.3849 4.59344 16.3598 4.57507 16.3337 4.5583L15.929 5.18976ZM18.166 7.05176L18.6968 6.52192C18.6805 6.50561 18.6635 6.49007 18.6458 6.47532L18.166 7.05176ZM18.5029 7.87264L19.2529 7.87676V7.87676L18.5029 7.87264ZM18.157 8.68976L17.632 8.15412C17.6108 8.17496 17.5908 8.19704 17.5721 8.22025L18.157 8.68976ZM16.1271 10.0203C15.8678 10.3433 15.9195 10.8153 16.2425 11.0746C16.5655 11.3339 17.0376 11.2823 17.2969 10.9593L16.1271 10.0203ZM13.4537 7.37862C13.3923 6.96898 13.0105 6.68666 12.6009 6.74805C12.1912 6.80943 11.9089 7.19127 11.9703 7.60091L13.4537 7.37862ZM16.813 11.2329C17.2234 11.1772 17.5109 10.7992 17.4552 10.3888C17.3994 9.97834 17.0215 9.69082 16.611 9.74659L16.813 11.2329ZM12.1238 7.02072L6.22577 14.3797L7.39623 15.3178L13.2942 7.95881L12.1238 7.02072ZM6.24297 14.359C6.03561 14.5995 5.91226 14.9011 5.89159 15.218L7.38841 15.3156C7.38786 15.324 7.38457 15.3321 7.37903 15.3385L6.24297 14.359ZM5.8908 15.2321L5.7508 18.2551L7.2492 18.3245L7.3892 15.3015L5.8908 15.2321ZM5.75396 18.3667C5.83563 19.1586 6.51588 19.7524 7.31152 19.7264L7.26248 18.2272C7.25928 18.2273 7.25771 18.2268 7.25669 18.2264C7.25526 18.2259 7.25337 18.2249 7.25144 18.2232C7.2495 18.2215 7.24825 18.2198 7.24754 18.2185C7.24703 18.2175 7.24637 18.216 7.24604 18.2128L5.75396 18.3667ZM7.45996 19.7065L10.46 18.9955L10.114 17.536L7.11404 18.247L7.45996 19.7065ZM10.4716 18.9927C10.7771 18.9151 11.05 18.7422 11.2506 18.499L10.0934 17.5445C10.0958 17.5417 10.0989 17.5397 10.1024 17.5388L10.4716 18.9927ZM11.2571 18.491L17.2971 10.959L16.1269 10.0206L10.0869 17.5526L11.2571 18.491ZM13.2971 7.95901L14.8851 5.97901L13.7149 5.04052L12.1269 7.02052L13.2971 7.95901ZM14.9135 5.94123C15.0521 5.74411 15.3214 5.6912 15.5243 5.82123L16.3337 4.5583C15.4544 3.99484 14.2873 4.2241 13.6865 5.0783L14.9135 5.94123ZM15.4492 5.7662L17.6862 7.6282L18.6458 6.47532L16.4088 4.61332L15.4492 5.7662ZM17.6352 7.58161C17.7111 7.6577 17.7535 7.761 17.7529 7.86852L19.2529 7.87676C19.2557 7.36905 19.0555 6.88127 18.6968 6.52192L17.6352 7.58161ZM17.7529 7.86852C17.7524 7.97604 17.7088 8.07886 17.632 8.15412L18.682 9.22541C19.0446 8.87002 19.2501 8.38447 19.2529 7.87676L17.7529 7.86852ZM17.5721 8.22025L16.1271 10.0203L17.2969 10.9593L18.7419 9.15928L17.5721 8.22025ZM11.9703 7.60091C12.3196 9.93221 14.4771 11.5503 16.813 11.2329L16.611 9.74659C15.0881 9.95352 13.6815 8.89855 13.4537 7.37862L11.9703 7.60091Z"
                                    fill="#6361D9" />
                            </g>
                        </svg>
                        <div class="comment-popup">
                            <textarea></textarea>
                            <svg style="position: absolute; bottom: 10px; right: 15px;" width="64px" height="64px"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M11.5003 12H5.41872M5.24634 12.7972L4.24158 15.7986C3.69128 17.4424 3.41613 18.2643 3.61359 18.7704C3.78506 19.21 4.15335 19.5432 4.6078 19.6701C5.13111 19.8161 5.92151 19.4604 7.50231 18.7491L17.6367 14.1886C19.1797 13.4942 19.9512 13.1471 20.1896 12.6648C20.3968 12.2458 20.3968 11.7541 20.1896 11.3351C19.9512 10.8529 19.1797 10.5057 17.6367 9.81135L7.48483 5.24303C5.90879 4.53382 5.12078 4.17921 4.59799 4.32468C4.14397 4.45101 3.77572 4.78336 3.60365 5.22209C3.40551 5.72728 3.67772 6.54741 4.22215 8.18767L5.24829 11.2793C5.34179 11.561 5.38855 11.7019 5.407 11.8459C5.42338 11.9738 5.42321 12.1032 5.40651 12.231C5.38768 12.375 5.34057 12.5157 5.24634 12.7972Z"
                                        stroke="#6361D9" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                            </svg>
                        </div>
                    </button>
                    <button data-id="{{ $file->id }}" class="tooltip">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" height="25"
                            width="25">
                            <path fill="#6361D9"
                                d="M8.78842 5.03866C8.86656 4.96052 8.97254 4.91663 9.08305 4.91663H11.4164C11.5269 4.91663 11.6329 4.96052 11.711 5.03866C11.7892 5.11681 11.833 5.22279 11.833 5.33329V5.74939H8.66638V5.33329C8.66638 5.22279 8.71028 5.11681 8.78842 5.03866ZM7.16638 5.74939V5.33329C7.16638 4.82496 7.36832 4.33745 7.72776 3.978C8.08721 3.61856 8.57472 3.41663 9.08305 3.41663H11.4164C11.9247 3.41663 12.4122 3.61856 12.7717 3.978C13.1311 4.33745 13.333 4.82496 13.333 5.33329V5.74939H15.5C15.9142 5.74939 16.25 6.08518 16.25 6.49939C16.25 6.9136 15.9142 7.24939 15.5 7.24939H15.0105L14.2492 14.7095C14.2382 15.2023 14.0377 15.6726 13.6883 16.0219C13.3289 16.3814 12.8414 16.5833 12.333 16.5833H8.16638C7.65805 16.5833 7.17054 16.3814 6.81109 16.0219C6.46176 15.6726 6.2612 15.2023 6.25019 14.7095L5.48896 7.24939H5C4.58579 7.24939 4.25 6.9136 4.25 6.49939C4.25 6.08518 4.58579 5.74939 5 5.74939H6.16667H7.16638ZM7.91638 7.24996H12.583H13.5026L12.7536 14.5905C12.751 14.6158 12.7497 14.6412 12.7497 14.6666C12.7497 14.7771 12.7058 14.8831 12.6277 14.9613C12.5495 15.0394 12.4436 15.0833 12.333 15.0833H8.16638C8.05588 15.0833 7.94989 15.0394 7.87175 14.9613C7.79361 14.8831 7.74972 14.7771 7.74972 14.6666C7.74972 14.6412 7.74842 14.6158 7.74584 14.5905L6.99681 7.24996H7.91638Z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
