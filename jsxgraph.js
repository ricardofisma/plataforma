var brd = JXG.JSXGraph.initBoard("jxgbox", {
  originX: 400,
  originY: 200,
  grid: true,
  unitX: 50,
  unitY: 50,
});
brd.createElement(
  "axis",
  [
    [0, 0],
    [1, 0],
  ],
  { strokeColor: "black" }
);
brd.createElement(
  "axis",
  [
    [0, 0],
    [0, 1],
  ],
  { strokeColor: "black" }
);
var b = brd.createElement(
  "slider",
  [
    [1, 3.5],
    [5, 3.5],
    [0, 1, 3],
  ],
  { name: "a", strokeColor: "black", fillColor: "white" }
);
var f = function (x) {
  return b.Value() * Math.sin(x);
};
var plot = brd.createElement("functiongraph", [f, -7, 7], {
  strokeColor: "#32CD32",
  strokeWidth: "4px",
});
var g = JXG.Math.Numerics.D(f);
var plot2 = brd.createElement("functiongraph", [g, -7, 7], {
  strokeColor: "#9370DB",
  strokeWidth: "2px",
});
var os = brd.createElement("riemannsum", [f, 35, "middle", -7, 7], {
  fillColor: "#B22222",
  fillOpacity: 0.3,
  strokeColor: "#8B1A1A",
  strokeWidth: "2px",
});
var t1 = brd.createElement("text", [-7, 2, "(a*sin(x))'"], {
  strokeColor: "#9370DB",
});
var t2 = brd.createElement("text", [-7, -1.5, "a*sin(x)"], {
  strokeColor: "#32CD32",
});
/* ]]> */
