export default class People {
    
    private name: String;
    private age: Number;
    private languages: Array<String>;

    constructor (
        name: String,
        age: Number,
        languages: Array<String>
    ) {
        this.name = name;
        this.age = age;
        this.languages = languages
    }

    public getName() {
        return this.name;
    }

    public getAge() {
        return this.age;
    }

    public getLanguages() {
        return this.languages;
    }

}