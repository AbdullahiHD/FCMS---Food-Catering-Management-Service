
// /*
// filename: [script.js]
// author: [Abdullahi Hussein Dahir]
// created: [7th September 2023]
// last modified: [24th October 2023]
// description: [html files it works on : Index.html]
// */

function init() {
    //Define the width and height of the SVG canvas
    var w = 500;
    var h = 450;

    var padding = 30;

    // Define the initial dataset
    var dataset = [24, 18, 29, 19, 8, 15, 20, 12, 9, 6, 21, 28];

    // X-Axis Scale
    var xScale = d3.scaleBand() // Ordinal Scale Method
        .domain(d3.range(dataset.length)) // Calculate the range of the domain
        .rangeRound([0, w]) // Specifying the size of the range the domain needs to be mapped to
        .paddingInner(0.05);    // Generating a padding value of 5% of the bandwidth

    // Y-Axis Scale
    var yScale = d3.scaleLinear()
        .domain([0, d3.max(dataset)])
        .range([h, 0]);
    
    // var xAxis = d3.axisBottom(xScale)
    //     .tickFormat(i => i + 1); // This is an example; format as needed

    // var yAxis = d3.axisLeft(yScale)
    //     .ticks(5); // Adjust the number of ticks as needed

    // // Append the x-axis
    // svg.append("g")
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + (h - padding) + ")")
    //     .call(xAxis);

    // // Append the y-axis
    // svg.append("g")
    //     .attr("class", "y axis")
    //     .attr("transform", "translate(" + padding + ",0)")
    //     .call(yAxis);

    // Create an SVG element and append it to the #chart-container of the HTML document
    var svg = d3.select("#chart-container")
        .append("svg")
        .attr("width", w)
        .attr("height", h);

    // Create a new rectangle for each data point
    svg.selectAll("rect")
        .data(dataset)
        .enter()
        .append("rect")
        .attr("x", function (d, i) {
            return xScale(i);
        })
        .attr("y", function (d) {
            return yScale(d);
        })
        // Initial grey colour
        .attr("fill", "slategrey")

        //Changing bar colour to orange on mouseover with transition
        .on("mouseover", function () {
            d3.select(this)
                .transition()
                .duration(200)
                .attr("fill", "orange");
        })

        // Changing the bar color on mouseover as well as having a tool tip
        .on("mouseover", function (event, d) {
            var xPosition = parseFloat(d3.select(this).attr("x")) + xScale.bandwidth() / 2 - 7; // Adjusted to center the text
            var yPosition = parseFloat(d3.select(this).attr("y")) + 14; // Adjusted so that the text is just under the bar roof

            d3.select(this)
                .transition()
                .duration(200)
                .attr("fill", "orange");

            svg.append("text")
                .attr("id", "tooltip")
                .attr("x", xPosition)
                .attr("y", yPosition)
                .attr("fill", "white")
                .text(d);

        })

        // Changing bar colour back to grey on removing the mouseover transition
        .on("mouseout", function () {
            svg.select("#tooltip").remove();
            d3.select(this)
                .transition()
                .duration(200)
                .attr("fill", "slategrey");
        })

        .attr("width", xScale.bandwidth())
        .attr("height", function (d) {
            return h - yScale(d);
        })

    // add bar function
    

    // function to remove a bar
   



    // Sort Ascending Function
    function sortBarsAscending() {
        svg.selectAll("rect")
            .sort(function (a, b) {
                return d3.ascending(a, b)
            })
            .transition()
            .delay(200)
            .duration(1500)
            .attr("x", function (d, i) {
                return xScale(i);
            });
    }

    // Sort Descending Function
    function sortBarsDescending() {
        svg.selectAll("rect")
            .sort(function (a, b) {
                return d3.descending(a, b)
            })
            .transition()
            .delay(200)
            .duration(2500)
            .attr("x", function (d, i) {
                return xScale(i);
            });
    }

    // var padding = 30; // Padding for the axis

    // // Create the x-axis
    // var xAxis = d3.axisBottom(xScale)
    //     .tickFormat(i => dataset[i]);

    // // Create the y-axis
    // var yAxis = d3.axisLeft(yScale)
    //     .ticks(5);

    // // Add the x-axis
    // svg.append("g")
    //     .attr("class", "x axis")
    //     .attr("transform", "translate(0," + (h - padding) + ")")
    //     .call(xAxis);

    // // Add the y-axis
    // svg.append("g")
    //     .attr("class", "y axis")
    //     .attr("transform", "translate(" + padding + ",0)")
    //     .call(yAxis);

    // Sort Ascending button
    d3.select(".sortAsc-button")
        .on("click", sortBarsAscending);

    // Sort Descending button
    d3.select(".sortDesc-button")
        .on("click", sortBarsDescending);

}

window.onload = init;




