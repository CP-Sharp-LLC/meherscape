var treemap;
var svg;

$(document).ready(function() {
    var dat = d3.hierarchy(projectdata).sum(
        function(d){
          return d.projects.length;
        });


    svg = d3.select("#maincontainer")
        .append('svg')
        .attr('width', '100%')
        .attr('height', '100%')
        .partition(dat);

    svg.selectAll('g')
        .data(projectdata)
        .enter().append('g')
        .text(function(d){ return d.name;});
    ///update(projectdata);}
});


    function update(source) {

        // Compute the new tree layout.
        var nodes = tree.nodes(source).reverse();

        var links = tree.links(nodes);

        // 1, 2, 3
        // Normalize for fixed-depth.
        nodes.forEach(function(d)
        {
            if (d.depth == 1)
            {
                // project set

            }

            if (d.depth == 2){
                // project

            }

            if (d.depth == 3){
                // image
            }
        });

        // Declare the nodes…
        var node = svg.selectAll("g.node")
            .data(nodes, function(d) { return d.id || (d.id = ++i); });

        // Enter the nodes.
        var nodeEnter = node.enter().append("g")
            .attr("class", "node")
            .attr("transform", function(d) {
                return "translate(" + d.y + "," + d.x + ")"; });

        nodeEnter.append("image")
            .attr("xlink:href", function(d) { return d.icon; })
            .attr("x", "-12px")
            .attr("y", "-12px")
            .attr("width", "24px")
            .attr("height", "24px");

        nodeEnter.append("text")
            .attr("x", function(d) {
                return d.children || d._children ?
                    (15) * -1 : + 15 })
            .attr("dy", ".35em")
            .attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "start"; })
            .text(function(d) { return d.name; })
            .style("fill-opacity", 1);

        // Declare the links…
        var link = svg.selectAll("path.link")
            .data(links, function(d) { return d.target.id; });

        // Enter the links.
        link.enter().insert("path", "g")
            .attr("class", "link")
            .style("stroke", function(d) { return d.target.level; })
            .attr("d", diagonal);

    }



