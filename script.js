function updateWordCount(textarea, counter) {
    let words = textarea.value.trim().split(/\s+/).filter(w => w.length > 0);
    let count = words.length;

    counter.innerText = count + " / 50 words";

    if (count > 50) {
        counter.style.color = "red";
    } else {
        counter.style.color = "green";
    }
}