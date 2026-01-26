document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".remove-fav").forEach(btn => {

    btn.addEventListener("click", () => {
      const game = btn.dataset.game;

      fetch("app/remove_favorite.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({ game })
      })
      .then(res => res.text())
      .then(data => {
        data = data.trim();

        if (data === "REMOVED") {
          btn.closest(".fav-item").remove();
          showToast("❌ Eliminado de favoritos");
        } else {
          showToast("⚠️ Error al eliminar");
        }
      });
    });

  });
});

function showToast(msg) {
  const toast = document.createElement("div");
  toast.innerText = msg;
  toast.style.position = "fixed";
  toast.style.top = "20px";
  toast.style.right = "20px";
  toast.style.background = "#ff4d4d";
  toast.style.color = "#fff";
  toast.style.padding = "12px 18px";
  toast.style.borderRadius = "8px";
  toast.style.fontWeight = "bold";
  toast.style.zIndex = "9999";
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 2500);
}
