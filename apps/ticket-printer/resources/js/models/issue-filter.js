export default class IssueFilter {

    static filter(searchString, arrayOfIssues)
    {
        let output = [];
        let regEx = new RegExp(searchString, "i");

        arrayOfIssues.forEach(function (value) {
            if(value.key.search(regEx)>=0) {
                output.push(value);
                return;
            }

            if(value.description.search(regEx)>=0) {
                output.push(value);
                return;
            }

            if(value.epic.search(regEx)>=0) {
                output.push(value);
                return;
            }
        });

        return output;
    }

}
