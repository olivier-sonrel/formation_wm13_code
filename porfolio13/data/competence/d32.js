var svg2 = d3.select("#svg2"),
    width = +svg2.attr("width"),
    height = +svg2.attr("height"),
    innerRadius2 = 90,
    outerRadius2 = Math.min(width, height) / 4,
    g2 = svg2.append("g").attr("transform", "translate(" + width / 4 + "," + height / 4 + ")");

var x = d3.scaleBand()
    .range([0, 2 * Math.PI])
    .align(0);

var y2 = d3.scaleRadial()
    .range([innerRadius2, outerRadius2]);

var z = d3.scaleOrdinal()
    .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b"]);

// Parcour tableau CSV et renvoie nbr couleur par column
d3.csv("./competence/data.csv", function(d, i, columns) {
  for (i = 1, t = 0; i < columns.length; ++i) t += d[columns[i]] = +d[columns[i]];
  d.total = t;
  return d;
}, function(error, data) {
  if (error) throw error;

  x.domain(data.map(function(d) { return d.Techno; }));
  y2.domain([0, d3.max(data, function(d) { return d.total; })]);
  z.domain(data.columns.slice(1));

  g2.append("g")
    .selectAll("g")
    .data(d3.stack().keys(data.columns.slice(1))(data))
    .enter().append("g")
      .attr("fill", function(d) { return z(d.key); })
    .selectAll("path")
    .data(function(d) { return d; })
    .enter().append("path")
      .attr("d", d3.arc()
          .innerRadius(function(d) { return y2(d[0]); })
          .outerRadius(function(d) { return y2(d[1]); })
          .startAngle(function(d) { return x(d.data.Techno); })
          .endAngle(function(d) { return x(d.data.Techno) + x.bandwidth(); })
          .padAngle(0.01)
          .padRadius(innerRadius2));

// Definit position nom competences
  var label = g2.append("g")
    .selectAll("g")
    .data(data)
    .enter().append("g")
      .attr("text-anchor", "middle") // definit position align middle text competence
      .attr("transform", function(d) { return "rotate(" + ((x(d.Techno) + x.bandwidth() / 2) * 180 / Math.PI - 90) + ")translate(" + innerRadius2 + ",0)"; });

  label.append("text")
      .attr("transform", function(d) { return (x(d.Techno) + x.bandwidth() / 2 + Math.PI / 2) % (2 * Math.PI) < Math.PI ? "rotate(90)translate(0,-45)"/*-25 position competence haute*/ : "rotate(-90)translate(0,55)"/*50 position competence basse*/; })
      .attr("font-size", "large")
      .text(function(d) { return d.Techno; });

// Definit position 20,40,60,80, et couleur
  // var yAxis = g2.append("g")
  //   .attr("stroke", "#fff")
  //   .attr("text-anchor", "middle");

  // var yTick = yAxis
  //   .selectAll("g")
  //   .data(y.ticks(5).slice(1))
  //   .enter().append("g");

// Attribut cerle fin, par ex couleur
  // yTick.append("circle") //cercle blanc
  //     .attr("fill", "none")
  //     .attr("stroke", "#fff")
  //     .attr("r", y);

  // yTick.append("text") //point blanc tout moche
  //     .attr("y", function(d) { return -y(d); })
  //     .attr("dy", "0.35em")
  //     .attr("fill", "none")
  //     .attr("stroke", "#fff")
  //     .attr("stroke-width", 5)
  //     .text(y.tickFormat(5, "s"));

  // yTick.append("text") //num blanc tout moche
  //     .attr("y", function(d) { return -y(d); })
  //     .attr("dy", "0.35em")
  //     .text(y.tickFormat(5, "s"));

  var legend = g2.append("g")
    .selectAll("g")
    .data(data.columns.slice(1).reverse())
    .enter().append("g")
      .attr("transform", function(d, i) { return "translate(-40," + (i - (data.columns.length - 1) / 2) * 20 + ")"; });

// Taille et position cube legende
  // legend.append("rect")
  //     .attr("width", 18)
  //     .attr("height", 18)
  //     .attr("fill", z);

  // legend.append("text")
  //     .attr("x", 24)
  //     .attr("y", 9)
  //     .attr("dy", "0.35em")
  //     .text(function(d) { return d; });
});
