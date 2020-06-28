$(document).ready(() => {

        let houndredItems = getHoundred();
        let counter = 0;

        for (item of houndredItems) {
            $(item).text(counter);
            counter++;
        }

    }
)

function getHoundred() {
    return $('.item').slice(0, 100);
}