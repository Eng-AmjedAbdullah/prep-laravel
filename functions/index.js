const functions = require("firebase-functions");
const express = require("express");
const path = require("path");

const app = express();

app.use(express.static(path.join(__dirname, "../public")));

app.get("*", (req, res) => {
  res.sendFile(path.join(__dirname, "../public/index.html"));
});

// Refactor to keep within the max length
const {https} = functions;
exports.app = https.onRequest(app);
