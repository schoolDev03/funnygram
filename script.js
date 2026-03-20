function countWords(textarea, counter){
    let words = textarea.value.trim().split(/\s+/).length;
    counter.innerText = words + "/50 words";
}