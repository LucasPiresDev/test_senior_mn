import { Vehicle } from "./Vehicle";

export class Car extends Vehicle {
    
    constructor(model: String, color: String) {
        super(model, color);
    }
}