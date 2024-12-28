const stripe = Stripe(
  "pk_test_51QaGyTRxzBBdnvlUgFYbjyCqCApkloGZf6t6hsknSOIZCN3J73UtbCay9zbV6Hv3njxleEAxzyIA3viVjv92p14f00fUUan23o"
); // Replace with your publishable key

document.getElementById("checkout-button").addEventListener("click", () => {
  fetch("stripe.php", {
    method: "POST",
  })
    .then((response) => response.json())
    .then((session) => {
      return stripe.redirectToCheckout({ sessionId: session.id });
    })
    .then((result) => {
      if (result.error) {
        alert(result.error.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
