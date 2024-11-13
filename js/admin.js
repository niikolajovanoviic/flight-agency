// SIDENAV
/* Open when someone clicks on the span element */
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
//   SIDENAV KRAJ

// animacija za broj
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

const obj = document.getElementById("prikazV");
var v = document.getElementById("pVrednost").value;
animateValue(obj, 0, v, 5000);

const obj1 = document.getElementById("prikazV1");
var v1 = document.getElementById("pVrednost1").value;
animateValue(obj1, 0, v1, 5000);

const obj2 = document.getElementById("prikazV2");
var v2 = document.getElementById("pVrednost2").value;
animateValue(obj2, 0, v2, 5000);

