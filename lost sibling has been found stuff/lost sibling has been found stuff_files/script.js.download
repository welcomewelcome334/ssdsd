const button = document.getElementById("submitBtn");
const input = document.getElementById("codeInput");

function normalize(code = "") {
  return code.toLowerCase().replace(/[^a-z0-9]/g, "");
}

function showError() {
  input.classList.add("error");
  input.classList.add("shake");

  setTimeout(() => {
    input.classList.remove("error");
    input.classList.remove("shake");
  }, 400);
}

function createOverlay(html) {
  const overlay = document.createElement("div");
  overlay.id = "secretOverlay";
  overlay.innerHTML = html;
  document.body.appendChild(overlay);

  setTimeout(() => overlay.classList.add("show"), 10);
}


async function showIdentity() {
  const res = await fetch("/identity-page");
  const html = await res.text();

  document.querySelector(".container").innerHTML = html;

  const input2 = document.getElementById("identityInput");
  const btn2 = document.getElementById("identityBtn");

  async function submit() {
    const identity = input2.value;

    const r = await fetch("/identity-check", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ identity })
    });

    const data = await r.json();

    const secret = await fetch("/secret-content", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        validIdentity: data.valid,
        name: data.name,
        token: data.token
      })
    });

    const html = await secret.text();
    createOverlay(html);
  }

  btn2.onclick = submit;
  input2.addEventListener("keydown", e => {
    if (e.key === "Enter") submit();
  });
}


async function submitCode() {
  const val = normalize(input.value);

  if (val.length < 3) return showError();

  const r = await fetch("/verify", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ code: input.value })
  });

  const data = await r.json();

  if (data.success) {

    if (data.thevideo) {

      const res = await fetch("/get-video", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ code: input.value })
      });

      const blob = await res.blob();
      const url = URL.createObjectURL(blob);

      const overlay = document.createElement("div");
      overlay.id = "secretOverlay";

      overlay.innerHTML = `
    <div style="
      width:100%;
      height:100%;
      display:flex;
      flex-direction:column;
      justify-content:center;
      align-items:center;
      background:black;
      color:white;
      font-family:Arial;
      gap:20px;
    ">
      <h1>theflashes.mov</h1>

      <video controls autoplay style="max-width:90vw; max-height:80vh;">
        <source src="${url}" type="video/mp4">
      </video>
    </div>
  `;

      document.body.appendChild(overlay);

      setTimeout(() => overlay.classList.add("show"), 10);

      return;
    }

    showIdentity();
  } else {
    showError();
    input.value = "";
  }
}

/* -------------------------
   EVENTS
-------------------------- */

button.onclick = submitCode;

input.addEventListener("keydown", e => {
  if (e.key === "Enter") submitCode();
});