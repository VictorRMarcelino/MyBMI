export type BMI = {
    id?: number;
    height: number;
    weight: number;
    created_at?: string;
    created_at_formatted?: string;
    result?: number;
    classification?: string;
}