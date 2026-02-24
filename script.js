(() => {
  const membershipToggles = document.querySelectorAll(".membership-toggle");

  membershipToggles.forEach((toggle) => {
    const targetSelector = toggle.getAttribute("data-bs-target");
    if (!targetSelector) {
      return;
    }

    const target = document.querySelector(targetSelector);
    if (!target) {
      return;
    }

    const syncState = () => {
      const isExpanded = target.classList.contains("show");
      toggle.setAttribute("aria-expanded", String(isExpanded));
      toggle.classList.toggle("collapsed", !isExpanded);
    };

    target.addEventListener("shown.bs.collapse", syncState);
    target.addEventListener("hidden.bs.collapse", syncState);
    syncState();
  });

  const callbackForm = document.getElementById("callbackForm");
  const successAlert = document.getElementById("formSuccess");

  if (!callbackForm || !successAlert) {
    return;
  }

  callbackForm.addEventListener("submit", (event) => {
    event.preventDefault();
    event.stopPropagation();

    if (!callbackForm.checkValidity()) {
      callbackForm.classList.add("was-validated");
      return;
    }

    callbackForm.classList.remove("was-validated");
    callbackForm.reset();

    successAlert.classList.remove("d-none");
    window.setTimeout(() => {
      successAlert.classList.add("d-none");
    }, 2800);
  });
})();
