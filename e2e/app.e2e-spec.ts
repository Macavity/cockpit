import { CockpitPage } from './app.po';

describe('cockpit App', function() {
  let page: CockpitPage;

  beforeEach(() => {
    page = new CockpitPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
