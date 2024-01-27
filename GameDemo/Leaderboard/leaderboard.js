"use strict";
const setButtonLeftAttr = (value) => {
  const buttonGroup = document.querySelector(".button-group");
  buttonGroup.dataset.left = value;
};
const buttonClick = (value) => {
  setButtonLeftAttr(value);
};

var weektable = document.getElementById("WeekTable");
var monthtable = document.getElementById("MonthTable");
var alltable = document.getElementById("AllTimeTable");

function showtable(id) {
  weektable.style.display = id == "WeekTable" ? "block" : "none";
  monthtable.style.display = id == "MonthTable" ? "block" : "none";
  alltable.style.display = id == "AllTimeTable" ? "block" : "none";
}
