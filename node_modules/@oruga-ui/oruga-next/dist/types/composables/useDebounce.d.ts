/**
 * Debounce a function
 * @param func function to debounce
 * @param wait debounce time to wait
 * @param immediate call immediate
 * @returns function to call
 */
export declare function useDebounce<A extends Array<unknown>>(func: (...args: A) => void, wait: number, immediate?: boolean): (...args: A) => void;
