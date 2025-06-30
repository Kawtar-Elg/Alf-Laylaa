function updateCounter(type, delta) {
  const countElement = document.getElementById(`${type}-count`);
  const inputElement = document.getElementById(`${type}-input`);
  let current = parseInt(countElement.textContent);
  if (current + delta >= 0) {
    current += delta;
    countElement.textContent = current;
    inputElement.value = current;
  }
}

window.addEventListener("load", function () {
  setTimeout(() => {
    document.getElementById("loadingOverlay").classList.add("hidden");
  }, 1500);
});
