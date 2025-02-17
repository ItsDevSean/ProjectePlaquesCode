export type IconConfig = {
    sizes?: {
        default: string;
        [key: string]: string;
    };
    iconPrefix?: string;
    internalIcons?: Record<string, string>;
};
declare const getIcons: () => Record<string, IconConfig>;
export default getIcons;
