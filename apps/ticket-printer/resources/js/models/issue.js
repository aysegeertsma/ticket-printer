export default class Issue {

    constructor(key, points, description, epic)
    {
        this.key = key;
        this.points = points;
        this.description = description;
        this.epic = epic;
        this.selected = true;
    }

    deselect()
    {
        this.selected = false;
    }

    select()
    {
        this.selected = true;
    }

    toggleSelected()
    {
        this.selected = !this.selected;
    }

    static fromObject(anObject)
    {
        return new Issue(
            anObject.key,
            anObject.points,
            anObject.description,
            anObject.epic
        )
    }
}
