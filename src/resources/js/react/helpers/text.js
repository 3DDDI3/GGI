export function nl2br( str ) {

    return str.replace(/([^>])\n/g, '$1<br/>');

}

export const getFormatedText = (text) => {
    return text.split('\n').map((str, i) => <p key={`p_${i}`}>{str}</p>);
}
